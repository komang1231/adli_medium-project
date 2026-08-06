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
