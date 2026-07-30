@extends('layouts.app')

@section('template_title')
    {{ $paymentProvider->name ?? __('Show') . " " . __('Payment Provider') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Payment Provider</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('payment-providers.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Kode Payment Provider:</strong>
                                    {{ $paymentProvider->kode_payment_provider }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Payment Method Id:</strong>
                                    {{ $paymentProvider->payment_method_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nama Payment Provider:</strong>
                                    {{ $paymentProvider->nama_payment_provider }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
