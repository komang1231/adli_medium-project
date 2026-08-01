<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentMethodRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PaymentMethod::query();

        $sort = $request->get('sort', 'asc');

        if ($request->filled('search')) {

            $query->where('kode_payment_method', 'like', '%' . $request->search . '%')
                ->orWhere('nama_payment_method', 'like', '%' . $request->search . '%');
        }

        $paymentMethods = $query
            ->orderBy('kode_payment_method', $sort)
            ->paginate(10);

        return view('payment-method.index', compact(
            'paymentMethods',
            'sort'
        ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $paymentMethod = new PaymentMethod();

        return view('payment-method.create', compact('paymentMethod'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentMethodRequest $request): RedirectResponse
    {
        PaymentMethod::create($request->validated());

        return Redirect::route('payment-methods.index')
            ->with('success', 'PaymentMethod created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $paymentMethod = PaymentMethod::find($id);

        return view('payment-method.show', compact('paymentMethod'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $paymentMethod = PaymentMethod::find($id);

        return view('payment-method.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentMethodRequest $request, PaymentMethod $paymentMethod): RedirectResponse
    {
        $paymentMethod->update($request->validated());

        return Redirect::route('payment-methods.index')
            ->with('success', 'PaymentMethod updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        PaymentMethod::find($id)->delete();

        return Redirect::route('payment-methods.index')
            ->with('success', 'PaymentMethod deleted successfully');
    }
}
