<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\PaymentMethod;
use App\Models\PaymentProvider;
use App\Models\TransaksiDetail;
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
        $items = json_decode($request->items, true);

        $menuIds = collect($items)
            ->pluck('menu_id');

        $menus = Menu::whereIn('id', $menuIds)
            ->get()
            ->keyBy('id');

        dd($items, $menus);
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
