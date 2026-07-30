@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? __('Show') . " " . __('User') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} User</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Kode User:</strong>
                                    {{ $user->kode_user }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Foto Profile:</strong>
                                    {{ $user->foto_profile }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nama User:</strong>
                                    {{ $user->nama_user }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Email:</strong>
                                    {{ $user->email }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>No Tlp:</strong>
                                    {{ $user->no_tlp }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Role:</strong>
                                    {{ $user->role }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $user->status }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
