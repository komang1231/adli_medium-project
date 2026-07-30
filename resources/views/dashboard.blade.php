@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- <h1 class="text-white">Dashboard</h1> --}}

        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="invoice-card card-purple">
                    <div class="label">Total invoices</div>
                    <div class="value">28893</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="invoice-card card-pink">
                    <div class="label">Total invoices</div>
                    <div class="value">28893</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="invoice-card card-orange">
                    <div class="label">Total invoices</div>
                    <div class="value">28893</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="invoice-card card-blue">
                    <div class="label">Total invoices</div>
                    <div class="value">28893</div>
                </div>
            </div>
        </div>

        
    </div>
@endsection
