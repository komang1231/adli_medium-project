@extends('layouts.app')

@section('template_title')
    {{ $transaksi->name ?? __('Show') . " " . __('Transaksi') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Transaksi</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('transaksis.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Kode Transaksi:</strong>
                                    {{ $transaksi->kode_transaksi }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status Pesanan:</strong>
                                    {{ $transaksi->status_pesanan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Member Id:</strong>
                                    {{ $transaksi->member_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tipe Pelanggan:</strong>
                                    {{ $transaksi->tipe_pelanggan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nama Pelanggan:</strong>
                                    {{ $transaksi->nama_pelanggan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>No Tlp:</strong>
                                    {{ $transaksi->no_tlp }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Payment Method Id:</strong>
                                    {{ $transaksi->payment_method_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Payment Provider Id:</strong>
                                    {{ $transaksi->payment_provider_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Transfer Bank Id:</strong>
                                    {{ $transaksi->transfer_bank_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ppn:</strong>
                                    {{ $transaksi->ppn }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Harga Ppn:</strong>
                                    {{ $transaksi->harga_ppn }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Service Charge:</strong>
                                    {{ $transaksi->service_charge }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Harga Service Charge:</strong>
                                    {{ $transaksi->harga_service_charge }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Diskon Member:</strong>
                                    {{ $transaksi->diskon_member }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Harga Diskon Member:</strong>
                                    {{ $transaksi->harga_diskon_member }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Grand Total:</strong>
                                    {{ $transaksi->grand_total }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>User Id:</strong>
                                    {{ $transaksi->user_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Paid At:</strong>
                                    {{ $transaksi->paid_at }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
