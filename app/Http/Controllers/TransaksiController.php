<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\PaymentMethod;
use App\Models\PaymentProvider;
use Illuminate\Support\Facades\DB;
use App\Models\Detail_Transaksi;
use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TransaksiRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaksi::query();

        $sort = $request->get('sort', 'asc');
        $status = $request->get('status');
        $paymentMethod = $request->get('payment_method');

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('kode_transaksi', 'like', '%' . $request->search . '%')
                    ->orWhere('nama_pelanggan', 'like', '%' . $request->search . '%');
            });
        }

        if (!empty($status)) {

            $query->where('status_pesanan', $status);
        }

        if (!empty($paymentMethod)) {

            $query->where('payment_method_id', $paymentMethod);
        }

        $transaksis = $query
            ->orderBy('id', $sort)
            ->paginate(10);

        $paymentMethods = PaymentMethod::orderBy('nama_payment_method')->get();

        return view('transaksi.index', compact(
            'transaksis',
            'paymentMethods',
            'paymentMethod',
            'status',
            'sort'
        ));
    }

    public function create(): View
    {
        $transaksi = new Transaksi();

        $menus = Menu::with('category')
            ->orderBy('nama_menu')
            ->get();

        $paymentProviders = PaymentProvider::with('paymentMethod')
            ->orderBy('payment_method_id')
            ->orderBy('nama_payment_provider')
            ->get();

        return view('transaksi.create', compact(
            'transaksi',
            'menus',
            'paymentProviders'
        ));
    }


    public function store(TransaksiRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $items = json_decode($request->items, true);

            $provider = PaymentProvider::with('paymentMethod')
                ->findOrFail($request->payment_provider_id);

            $menus = Menu::whereIn(
                'id',
                collect($items)->pluck('menu_id')
            )->get()->keyBy('id');

            $subtotal = 0;

            foreach ($items as &$item) {

                $menu = $menus[$item['menu_id']];

                $item['harga'] = $menu->harga;
                $item['subtotal'] = $menu->harga * $item['qty'];

                $subtotal += $item['subtotal'];
            }

            $isMember = $request->is_member == 1;

            $diskon = $isMember ? $subtotal * 0.10 : 0;

            $service = 2000;

            $ppn = ($subtotal - $diskon + $service) * 0.11;

            $grandTotal = ($subtotal - $diskon) + $service + $ppn;

            $transaksi = Transaksi::create([

                'status_pesanan' => 'paid',

                'members_id' => $request->customer_id ?: null,

                'tipe_pelanggan' => $isMember ? 'Member' : 'Non-Member',

                'nama_pelanggan' => $request->nama_pelanggan,

                'no_tlp' => $request->no_tlp,

                'payment_method_id' => $provider->payment_method_id,

                'payment_provider_id' => $provider->id,

                'ppn' => 11,

                'harga_ppn' => $ppn,

                'service_charge' => 10,
                'harga_service_charge' => $service,

                'member_discount' => $isMember ? 10 : 0,

                'harga_member_discount' => $diskon,

                'grand_total' => $grandTotal,

                'user_id' => auth()->id(),

            ]);

            foreach ($items as $item) {

                Detail_Transaksi::create([

                    'transaksi_id' => $transaksi->id,

                    'menu_id' => $item['menu_id'],

                    'jumlah' => $item['qty'],

                    'harga_satuan' => $item['harga'],

                    'subtotal_harga' => $item['subtotal'],

                ]);

                $menu = $menus[$item['menu_id']];

                $menu->decrement('stok', $item['qty']);
            }

            DB::commit();

            return redirect()
                ->route('transaksis.index')
                ->with('success', 'Transaksi berhasil dibuat.');
        } catch (\Throwable $e) {

            DB::rollBack();

            throw $e;
        }
    }

    public function show($id): View
    {
        $transaksi = Transaksi::find($id);

        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $transaksi = Transaksi::find($id);

        return view('transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransaksiRequest $request, Transaksi $transaksi): RedirectResponse
    {
        $transaksi->update($request->validated());

        return Redirect::route('transaksis.index')
            ->with('success', 'Transaksi updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Transaksi::find($id)->delete();

        return Redirect::route('transaksis.index')
            ->with('success', 'Transaksi deleted successfully');
    }
}
