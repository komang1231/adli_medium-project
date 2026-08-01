@extends('layouts.app')

@section('template_title')
    Payment Methods
@endsection

@section('content')
    <div class="content-card">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h5>Payment</h5>

        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <a href="{{ route('payment-methods.index') }}"
                    class="btn {{ request()->routeIs('payment-methods.*') ? 'btn-payment-active' : 'btn-add' }} me-2">

                    <img class="icon" src="{{ asset('assets/icons/payment/method.svg') }}" alt="">

                    Method

                </a>

                <a href="{{ route('payment-providers.index') }}"
                    class="btn {{ request()->routeIs('payment-providers.*') ? 'btn-payment-active' : 'btn-add' }}">

                    <img class="icon" src="{{ asset('assets/icons/payment/provider.svg') }}" alt="">

                    Providers

                </a>

            </div>

            <div class="d-flex align-items-center">

                <form action="{{ route('payment-methods.index') }}" method="GET" class="d-flex align-items-center">

                    <a href="{{ route('payment-methods.index', [
                        'search' => request('search'),
                        'sort' => $sort == 'asc' ? 'desc' : 'asc',
                    ]) }}"
                        class="sort-btn me-2 px-2 py-2">

                        <img src="{{ asset($sort == 'asc' ? 'assets/icons/table/sort_up.svg' : 'assets/icons/table/sort_down.svg') }}"
                            alt="Sort">

                    </a>

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

                        <th width="70">No</th>

                        <th width="200">Kode</th>

                        <th width="200">Nama Payment Method</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($paymentMethods as $paymentMethod)
                        <tr>

                            <td>{{ $paymentMethods->firstItem() + $loop->index }}</td>

                            <td>{{ $paymentMethod->kode_payment_method }}</td>

                            <td>{{ $paymentMethod->nama_payment_method }}</td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3" class="text-center">

                                Belum ada data payment method.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">

            <span class="entries-info">

                Showing {{ $paymentMethods->firstItem() ?? 0 }}
                to {{ $paymentMethods->lastItem() ?? 0 }}
                of {{ $paymentMethods->total() }} entries

            </span>

            {{ $paymentMethods->withQueryString()->links() }}

        </div>

    </div>
@endsection
