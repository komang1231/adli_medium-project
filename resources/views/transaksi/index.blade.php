@extends('layouts.app')

@section('template_title')
    Transaksi
@endsection

@section('content')
    <div class="content-card">

        @if ($errors->any())
            <div class="alert alert-danger">

                {{ $errors->first() }}

            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h5>Data Transaksi</h5>

        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <a href="{{ route('transaksis.create') }}" class="btn btn-add me-2">

                    <img class="icon" src="{{ asset('assets/icons/table/add.svg') }}" alt="">

                    Add

                </a>

                <a href="{{ route('transaksis.trash') }}" class="btn btn-trash">

                    <img class="icon" src="{{ asset('assets/icons/table/trash.svg') }}" alt="">

                    Trash

                </a>

            </div>

            <div class="d-flex align-items-center">

                <form action="{{ route('transaksis.index') }}" method="GET" class="d-flex align-items-center">

                    <a href="{{ route('transaksis.index', [
                        'search' => request('search'),
                        'status' => request('status'),
                        'payment_method' => request('payment_method'),
                        'sort' => $sort == 'asc' ? 'desc' : 'asc',
                    ]) }}"
                        class="sort-btn me-2 px-2 py-2">

                        <img
                            src="{{ asset($sort == 'asc' ? 'assets/icons/table/sort_up.svg' : 'assets/icons/table/sort_down.svg') }}">

                    </a>

                    <x-filter-popup id="transaksi-filter">

                        <x-filter-section label="Status" filter-key="status">

                            <x-filter-radio name="status" value="" :checked="$status == ''">

                                Semua

                            </x-filter-radio>

                            <x-filter-radio name="status" value="paid" :checked="$status == 'paid'">

                                Paid

                            </x-filter-radio>

                            <x-filter-radio name="status" value="unpaid" :checked="$status == 'unpaid'">

                                Unpaid

                            </x-filter-radio>

                        </x-filter-section>

                        <x-filter-section label="Payment Method" filter-key="payment_method">

                            <x-filter-radio name="payment_method" value="" :checked="$paymentMethod == ''">

                                Semua

                            </x-filter-radio>

                            @foreach ($paymentMethods as $method)
                                <x-filter-radio name="payment_method" value="{{ $method->id }}" :checked="$paymentMethod == $method->id">

                                    {{ $method->nama_payment_method }}

                                </x-filter-radio>
                            @endforeach

                        </x-filter-section>

                    </x-filter-popup>

                    <input type="text" name="search" class="search-box" placeholder="Cari..."
                        value="{{ request('search') }}">

                    <button type="submit" class="search-icon-btn">

                        <img src="{{ asset('assets/icons/table/search.svg') }}" alt="">

                    </button>

                </form>

            </div>

        </div>

        <div class="table-responsive">

            <table class="table">

                <thead>

                    <tr>

                        <th width="20">No</th>

                        <th width="190">Kode</th>

                        <th width="120">Tipe</th>

                        <th width="120">Payment</th>

                        <th>Total</th>

                        <th width="180">Tanggal</th>

                        <th class="text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($transaksis as $transaksi)
                        <tr>

                            <td>{{ $transaksis->firstItem() + $loop->index }}</td>

                            <td>{{ $transaksi->kode_transaksi }}</td>

                            <td>{{ $transaksi->tipe_pelanggan }}</td>

                            <td>{{ $transaksi->paymentMethod->nama_payment_method }}</td>

                            <td>
                                Rp {{ number_format($transaksi->grand_total, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ $transaksi->created_at->translatedFormat('d F Y') }}
                            </td>

                            <td class="text-center">

                                <a href="{{ route('transaksis.show', $transaksi->id) }}" class="btn-detail">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <button type="button" class="btn-hapus ms-2">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center">

                                Belum ada data transaksi.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">

            <span class="entries-info">

                Showing {{ $transaksis->firstItem() ?? 0 }}
                to {{ $transaksis->lastItem() ?? 0 }}
                of {{ $transaksis->total() }} entries

            </span>

            {{ $transaksis->withQueryString()->links() }}

        </div>

    </div>
@endsection
