{{-- @extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Transaksi
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Transaksi</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('transaksis.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('transaksi.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection --}}



@extends('layouts.app')

@section('template_title')
    {{ __('Tambah Transaksi') }}
@endsection

@section('content')
    <form id="form-add-transaksi" method="POST" action="{{ route('transaksis.store') }}">
        @csrf
        <section class="content container-fluid pos-page">
            <div class="row g-3">

                {{-- ===================== KIRI ===================== --}}
                <div class="col-lg-8">

                    {{-- 1. Informasi Pelanggan --}}
                    <div class="pos-card mb-3">
                        <div class="pos-card-title">{{ __('Informasi Pelanggan') }}</div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="customer_name" class="form-label">{{ __('Nama Pelanggan') }}</label>
                                <div class="pos-input-wrapper">
                                    <input type="text" id="customer_name" name="nama_pelanggan" class="form-control"
                                        placeholder="Cari nama pelanggan" autocomplete="off">
                                    <i class="bi bi-check-circle-fill pos-check-icon" id="customer_name_check" hidden></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="customer_phone" class="form-label">{{ __('No Telepon') }}</label>
                                <div class="pos-input-wrapper">
                                    <input type="text" id="customer_phone" name="no_tlp" class="form-control"
                                        placeholder="08xx-xxxx-xxxx" autocomplete="off">
                                    <i class="bi bi-check-circle-fill pos-check-icon" id="customer_phone_check" hidden></i>
                                </div>
                            </div>
                        </div>

                        <div class="pos-member-status mt-2" id="memberStatus">
                            <span class="pos-badge pos-badge-neutral">{{ __('Non Member') }}</span>
                        </div>

                        {{-- Hidden fields — akan dipakai backend nanti --}}
                        <input type="hidden" id="is_member" value="0">
                        <input type="hidden" id="customer_id" value="">
                    </div>

                    {{-- 2. Payment --}}
                    <div class="pos-card mb-3">
                        <div class="pos-card-title">{{ __('Payment Provider') }}</div>

                        <div id="paymentProviderGroups">
                            {{-- Diisi via JS dari data dummy (nanti diganti data provider dari backend) --}}
                        </div>

                        <input type="hidden" id="payment_provider_id" value="">
                    </div>

                    {{-- 3. Cari Menu --}}
                    <div class="pos-card mb-3 pos-menu-search-card">
                        <div class="pos-card-title">{{ __('Cari Menu') }}</div>

                        <div class="pos-search-wrapper">
                            <i class="bi bi-search pos-search-icon"></i>
                            <input type="text" id="menuSearch" class="form-control pos-search-input"
                                placeholder="Ketik nama menu..." autocomplete="off">
                        </div>

                        <div class="pos-menu-dropdown" id="menuDropdown" hidden></div>
                    </div>

                    {{-- 4. Daftar Pesanan --}}
                    <div class="pos-card">
                        <div class="pos-card-title">{{ __('Daftar Pesanan') }}</div>

                        <div id="orderList" class="pos-order-list">
                            <div class="pos-order-empty" id="orderEmpty">
                                {{ __('Belum ada menu dipilih. Cari menu di atas untuk mulai pesanan.') }}
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ===================== KANAN ===================== --}}
                <div class="col-lg-4">
                    <div class="pos-summary-sticky">

                        <div class="pos-card mb-3">
                            <div class="pos-card-title">{{ __('Ringkasan Pembayaran') }}</div>

                            <div class="pos-summary-row">
                                <span>{{ __('Subtotal') }}</span>
                                <span id="sumSubtotal">Rp 0</span>
                            </div>
                            <div class="pos-summary-row pos-summary-discount">
                                <span>{{ __('Diskon Member') }}</span>
                                <span id="sumDiscount">- Rp 0</span>
                            </div>
                            <div class="pos-summary-row">
                                <span>{{ __('Service') }}</span>
                                <span id="sumService">Rp 0</span>
                            </div>
                            <div class="pos-summary-row">
                                <span>{{ __('PPN 11%') }}</span>
                                <span id="sumTax">Rp 0</span>
                            </div>

                            <div class="pos-summary-total">
                                <span>{{ __('Grand Total') }}</span>
                                <span id="sumGrandTotal">Rp 0</span>
                            </div>
                        </div>


                        @csrf
                        <input type="hidden" name="customer_id" id="form_customer_id">
                        <input type="hidden" name="is_member" id="form_is_member">
                        <input type="hidden" name="payment_provider_id" id="form_payment_provider_id">
                        <input type="hidden" name="items" id="form_items">

                        <button id="btn-tambah-transaksi" type="submit" class="btn-pos-primary" id="btnSaveTransaction">
                            <span id="btn-tambah-text">{{ __('Simpan Transaksi') }}</span>
                            <span id="btn-tambah-spinner" class="spinner d-none"></span>
                        </button>
                        <a href="{{ url()->previous() }}" class="btn-pos-secondary">
                            {{ __('Batal') }}
                        </a>


                    </div>
                </div>

            </div>
        </section>
    </form>
@endsection
<script>
    window.paymentProviders = @json($paymentProviders);
    window.menus = @json($menus);
</script>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/transaksi.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/transaksi.js') }}"></script>
@endpush
