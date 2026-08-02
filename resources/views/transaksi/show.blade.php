<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>

<body>


    <section class="content container-fluid invoice-page">

        <div class="invoice-header">
            <div>
                <div class="invoice-title">{{ __('Invoice Transaksi') }}</div>
                <div class="invoice-subtitle">{{ __('Detail transaksi pelanggan.') }}</div>
            </div>
        </div>

        <div id="invoicePrintArea">

            {{-- ===================== 3 CARD INFO ===================== --}}
            <div class="row g-3 mb-3">

                {{-- Informasi Transaksi --}}
                <div class="col-lg-4">
                    <div class="invoice-card">
                        <div class="invoice-card-title">{{ __('Informasi Transaksi') }}</div>

                        <div class="invoice-row">
                            <span>{{ __('Kode') }}</span>
                            <span>{{ $transaksi->kode_transaksi }}</span>
                        </div>
                        <div class="invoice-row">
                            <span>{{ __('Status') }}</span>
                            <span class="invoice-badge invoice-badge-success">{{ $transaksi->status }}</span>
                        </div>
                        <div class="invoice-row">
                            <span>{{ __('Tanggal') }}</span>
                            <span>{{ $transaksi->created_at->locale('id')->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="invoice-row">
                            <span>{{ __('Jam') }}</span>
                            <span>{{ $transaksi->created_at->format('H:i') }} WITA</span>
                        </div>
                        <div class="invoice-row invoice-row-last">
                            <span>{{ __('Staff') }}</span>
                            <span>{{ $transaksi->staff->nama_user }}</span>
                        </div>
                    </div>
                </div>

                {{-- Informasi Pelanggan --}}
                <div class="col-lg-4">
                    <div class="invoice-card">
                        <div class="invoice-card-title">{{ __('Informasi Pelanggan') }}</div>

                        <div class="invoice-row">
                            <span>{{ __('Nama') }}</span>
                            <span>{{ $transaksi->nama_pelanggan }}</span>
                        </div>
                        <div class="invoice-row">
                            <span>{{ __('No Telepon') }}</span>
                            <span>{{ $transaksi->no_tlp_pelanggan }}</span>
                        </div>
                        <div class="invoice-row invoice-row-last">
                            <span>{{ __('Tipe') }}</span>
                            @if ($transaksi->is_member)
                                <span class="invoice-badge invoice-badge-member">{{ __('Member') }}</span>
                            @else
                                <span class="invoice-badge invoice-badge-neutral">{{ __('Non Member') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Informasi Pembayaran --}}
                <div class="col-lg-4">
                    <div class="invoice-card">
                        <div class="invoice-card-title">{{ __('Informasi Pembayaran') }}</div>

                        <div class="invoice-row">
                            <span>{{ __('Method') }}</span>
                            <span>{{ $transaksi->payment_method }}</span>
                        </div>
                        <div
                            class="invoice-row {{ $transaksi->payment_method !== 'Transfer Bank' ? 'invoice-row-last' : '' }}">
                            <span>{{ __('Provider') }}</span>
                            <span>{{ $transaksi->payment_provider }}</span>
                        </div>

                        @if ($transaksi->payment_method === 'Transfer Bank')
                            <div class="invoice-divider"></div>

                            <div class="invoice-row">
                                <span>{{ __('Nama Bank') }}</span>
                                <span>{{ $transaksi->nama_bank }}</span>
                            </div>
                            <div class="invoice-row">
                                <span>{{ __('No Rekening') }}</span>
                                <span>{{ $transaksi->no_rekening }}</span>
                            </div>
                            <div class="invoice-row invoice-row-last">
                                <span>{{ __('Pemilik') }}</span>
                                <span>{{ $transaksi->nama_pemilik_rekening }}</span>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- ===================== DAFTAR MENU ===================== --}}
            <div class="invoice-card mb-3">
                <div class="invoice-card-title">{{ __('Daftar Menu') }}</div>

                <div class="table-responsive">
                    <table class="table invoice-table">
                        <thead>
                            <tr>
                                <th style="width: 48px;">{{ __('No') }}</th>
                                <th>{{ __('Nama Menu') }}</th>
                                <th class="text-end">{{ __('Harga Satuan') }}</th>
                                <th class="text-center">{{ __('Jumlah') }}</th>
                                <th class="text-end">{{ __('Subtotal') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi->items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->menu->nama_menu }}</td>
                                    <td class="text-end">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->qty }}</td>
                                    <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ===================== RINGKASAN PEMBAYARAN ===================== --}}
            <div class="row mb-4">
                <div class="col-lg-4 offset-lg-8">
                    <div class="invoice-card">
                        <div class="invoice-card-title">{{ __('Ringkasan Pembayaran') }}</div>

                        <div class="invoice-summary-row">
                            <span>{{ __('Subtotal') }}</span>
                            <span>Rp {{ number_format($transaksi->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="invoice-summary-row invoice-summary-discount">
                            <span>{{ __('Diskon Member') }}</span>
                            <span>- Rp {{ number_format($transaksi->diskon_member, 0, ',', '.') }}</span>
                        </div>
                        <div class="invoice-summary-row">
                            <span>{{ __('Service Charge') }}</span>
                            <span>Rp {{ number_format($transaksi->service_charge, 0, ',', '.') }}</span>
                        </div>
                        <div class="invoice-summary-row">
                            <span>{{ __('PPN') }}</span>
                            <span>Rp {{ number_format($transaksi->ppn, 0, ',', '.') }}</span>
                        </div>

                        <div class="invoice-summary-total">
                            <span>{{ __('Grand Total') }}</span>
                            <span>Rp {{ number_format($transaksi->grand_total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ===================== FOOTER ACTION ===================== --}}
        <div class="invoice-footer">
            <a href="{{ route('transaksis.index') }}" class="btn-invoice-secondary">
                <i class="bi bi-arrow-left"></i>
                {{ __('Kembali') }}
            </a>

            <button type="button" class="btn-invoice-primary" onclick="window.print()">
                <i class="bi bi-printer"></i>
                {{ __('Cetak Invoice') }}
            </button>
        </div>

    </section>
</body>

</html>


{{-- @push('styles')
    <style>
        /* =========================================================
               INVOICE / DETAIL TRANSAKSI
               ========================================================= */

        .invoice-page {
            padding-bottom: 40px;
        }

        .invoice-header {
            margin-bottom: 24px;
        }

        .invoice-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--white);
        }

        .invoice-subtitle {
            font-size: 13px;
            color: var(--neutral-text);
            margin-top: 2px;
        }

        .invoice-card {
            background-color: var(--neutral-sidebar);
            border-radius: 14px;
            padding: 18px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
            height: 100%;
        }

        .invoice-card-title {
            font-size: 11px;
            color: var(--role-text);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 12px;
        }

        .invoice-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            margin-bottom: 8px;
            color: var(--white);
        }

        .invoice-row span:first-child {
            color: var(--neutral-text);
        }

        .invoice-row-last {
            margin-bottom: 0;
        }

        .invoice-divider {
            height: 1px;
            background-color: var(--neutral-pagination);
            margin: 10px 0;
        }

        .invoice-badge {
            font-size: 11px;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 999px;
        }

        .invoice-badge-success {
            background-color: rgba(99, 153, 34, 0.18);
            color: #97C459;
        }

        .invoice-badge-member {
            background-color: rgba(85, 85, 170, 0.25);
            color: #8F8FD1;
        }

        .invoice-badge-neutral {
            background-color: var(--neutral-pagination);
            color: var(--neutral-text);
        }

        /* ---------- Table ---------- */

        .invoice-table {
            color: var(--white);
            margin-bottom: 0;
        }

        .invoice-table thead th {
            font-size: 12px;
            font-weight: 500;
            color: var(--role-text);
            border-bottom: 1px solid var(--neutral-pagination);
            padding: 8px 6px;
        }

        .invoice-table tbody td {
            font-size: 13px;
            padding: 10px 6px;
            border-bottom: 1px solid var(--neutral-pagination-active-10, #232849);
            vertical-align: middle;
        }

        .invoice-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* ---------- Ringkasan Pembayaran ---------- */

        .invoice-summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: var(--neutral-text);
            margin-bottom: 8px;
        }

        .invoice-summary-row span:last-child {
            color: var(--white);
        }

        .invoice-summary-discount span:last-child {
            color: #97C459;
        }

        .invoice-summary-total {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            border-top: 1px solid var(--neutral-pagination);
            padding-top: 14px;
            margin-top: 6px;
        }

        .invoice-summary-total span:first-child {
            font-size: 13px;
            color: var(--role-text);
        }

        .invoice-summary-total span:last-child {
            font-size: 22px;
            font-weight: 600;
            color: var(--white);
        }

        /* ---------- Footer ---------- */

        .invoice-footer {
            display: flex;
            justify-content: space-between;
        }

        .btn-invoice-secondary {
            background-color: transparent;
            color: var(--neutral-text);
            border: 1px solid var(--neutral-pagination);
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: border-color 150ms ease, color 150ms ease;
        }

        .btn-invoice-secondary:hover {
            border-color: var(--white);
            color: var(--white);
        }

        .btn-invoice-primary {
            background-color: var(--neutral-pagination-active);
            color: var(--white);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: opacity 150ms ease;
        }

        .btn-invoice-primary:hover {
            opacity: 0.9;
            color: var(--white);
        }

        /* =========================================================
               PRINT-READY
               — sembunyikan semua chrome dashboard (sidebar, topbar, footer
                 aksi), tampilkan invoice-nya saja dengan warna print-friendly.
               ========================================================= */

        @media print {
            body * {
                visibility: hidden;
            }

            #invoicePrintArea,
            #invoicePrintArea * {
                visibility: visible;
            }

            #invoicePrintArea {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                margin: 0;
                padding: 0;
            }

            .invoice-card {
                background-color: #ffffff !important;
                color: #1a1a1a !important;
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }

            .invoice-card-title,
            .invoice-row span:first-child,
            .invoice-summary-row,
            .invoice-summary-total span:first-child,
            .invoice-table thead th {
                color: #666 !important;
            }

            .invoice-row,
            .invoice-summary-row span:last-child,
            .invoice-summary-total span:last-child,
            .invoice-table tbody td {
                color: #1a1a1a !important;
            }

            .invoice-badge-success,
            .invoice-badge-member,
            .invoice-badge-neutral {
                border: 1px solid #ccc !important;
            }
        }
    </style>
@endpush --}}
