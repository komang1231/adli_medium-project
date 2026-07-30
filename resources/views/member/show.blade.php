@extends('layouts.app')

@section('template_title')
    {{ $member->name ?? __('Show') . " " . __('Member') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Member</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('members.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Kode Pelanggan:</strong>
                                    {{ $member->kode_pelanggan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nama Pelanggan:</strong>
                                    {{ $member->nama_pelanggan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>No Tlp:</strong>
                                    {{ $member->no_tlp }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $member->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Expired At:</strong>
                                    {{ $member->expired_at }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
