@extends('layouts.app')

@section('template_title')
    {{ __('Show') }} Member
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
                            <strong>Nomor Telp:</strong>
                            {{ $member->no_tlp }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Status:</strong>
                            {{ $member->expired_status }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Expired At:</strong>
                            {{ $member->expired_at ? $member->expired_at->format('d-m-Y') : '-' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Keterangan:</strong>
                            @if ($member->expired_at)
                                @if ($member->expired_status === 'Non-Active')
                                    Member sudah kadaluarsa pada {{ $member->expired_at->format('d-m-Y') }}.
                                @else
                                    Berlaku sampai {{ $member->expired_at->format('d-m-Y') }}.
                                @endif
                            @else
                                Belum ada masa berlaku member.
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
