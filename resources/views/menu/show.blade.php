@extends('layouts.app')

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
@endsection
