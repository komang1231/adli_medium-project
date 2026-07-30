<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
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
    public function index(Request $request): View
    {
        $transaksis = Transaksi::paginate();

        return view('transaksi.index', compact('transaksis'))
            ->with('i', ($request->input('page', 1) - 1) * $transaksis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $transaksi = new Transaksi();

        return view('transaksi.create', compact('transaksi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransaksiRequest $request): RedirectResponse
    {
        Transaksi::create($request->validated());

        return Redirect::route('transaksis.index')
            ->with('success', 'Transaksi created successfully.');
    }

    /**
     * Display the specified resource.
     */
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
