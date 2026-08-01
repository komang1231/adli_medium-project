{{-- @extends('layouts.app')

@section('template_title')
    {{ $menu->name ?? __('Show') . " " . __('Menu') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Menu</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('menus.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Kode Menu:</strong>
                                    {{ $menu->kode_menu }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nama Menu:</strong>
                                    {{ $menu->nama_menu }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Harga:</strong>
                                    {{ $menu->harga }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Stok:</strong>
                                    {{ $menu->stok }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Foto Menu:</strong>
                                    {{ $menu->foto_menu }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Category Id:</strong>
                                    {{ $menu->category_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection --}}

@extends('layouts.app')

@section('template_title')
    Detail Menu
@endsection

@section('content')
    <div class="content-card">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <a href="{{ route('menus.index') }}" class="btn btn-add">

                <img class="icon" src="{{ asset('assets/icons/table/back.svg') }}" alt="">

                Back

            </a>

            <h5>Detail Menu</h5>

        </div>

        {{-- Foto --}}
        <div class="text-center mb-4">

            @if ($menu->foto_menu)
                <img src="{{ asset('storage/' . $menu->foto_menu) }}" class="menu-detail-image">
            @else
                <div class="menu-no-image">

                    No Image

                </div>
            @endif

        </div>

        {{-- Detail --}}
        <table class="table table-borderless">

            <tr>
                <th width="220">Kode Menu</th>
                <td>{{ $menu->kode_menu }}</td>
            </tr>

            <tr>
                <th>Nama Menu</th>
                <td>{{ $menu->nama_menu }}</td>
            </tr>

            <tr>
                <th>Harga</th>
                <td>Rp{{ number_format($menu->harga, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <th>Stok</th>
                <td>{{ $menu->stok }}</td>
            </tr>

            <tr>
                <th>Kategori</th>
                <td>{{ $menu->category->nama_category }}</td>
            </tr>

            <tr>
                <th>Dibuat</th>
                <td>{{ $menu->created_at->format('d M Y H:i') }}</td>
            </tr>

            <tr>
                <th>Diubah</th>
                <td>{{ $menu->updated_at->format('d M Y H:i') }}</td>
            </tr>

        </table>

        {{-- Tombol --}}
        <div class="text-end mt-4">

            <button class="btn btn-edit">

                Edit

            </button>

            <button class="btn btn-hapus ms-2">

                Hapus

            </button>

        </div>

    </div>
@endsection
