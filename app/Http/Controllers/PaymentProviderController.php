<?php

namespace App\Http\Controllers;

use App\Models\PaymentProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentProviderRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PaymentProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $paymentProviders = PaymentProvider::paginate();

        return view('payment-provider.index', compact('paymentProviders'))
            ->with('i', ($request->input('page', 1) - 1) * $paymentProviders->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $paymentProvider = new PaymentProvider();

        return view('payment-provider.create', compact('paymentProvider'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentProviderRequest $request): RedirectResponse
    {
        PaymentProvider::create($request->validated());

        return Redirect::route('payment-providers.index')
            ->with('success', 'PaymentProvider created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $paymentProvider = PaymentProvider::find($id);

        return view('payment-provider.show', compact('paymentProvider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $paymentProvider = PaymentProvider::find($id);

        return view('payment-provider.edit', compact('paymentProvider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentProviderRequest $request, PaymentProvider $paymentProvider): RedirectResponse
    {
        $paymentProvider->update($request->validated());

        return Redirect::route('payment-providers.index')
            ->with('success', 'PaymentProvider updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        PaymentProvider::find($id)->delete();

        return Redirect::route('payment-providers.index')
            ->with('success', 'PaymentProvider deleted successfully');
    }
}
