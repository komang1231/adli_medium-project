@extends('layouts.app')

@section('template_title')
    Detail User
@endsection

@section('content')
    <div class="content-card">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h5>Detail User</h5>

            <a href="{{ route('users.index') }}" class="btn btn-secondary">

                Kembali

            </a>

        </div>

        <div class="row">

            <div class="col-lg-4">

                <div class="text-center">

                    @if ($user->foto_profile)
                        <img src="{{ asset('storage/' . $user->foto_profile) }}" class="rounded-circle border"
                            style="
            width:180px;
            height:180px;
            object-fit:cover;
        ">
                    @else
                        <img src="{{ asset('assets/icons/topbar/profile.svg') }}" class="rounded-circle border p-3"
                            style="
            width:180px;
            height:180px;
            object-fit:contain;
        ">
                    @endif

                </div>

            </div>

            <div class="col-lg-8">

                <table class="table table-borderless">

                    <tr>
                        <th width="180">Kode User</th>
                        <td>{{ $user->kode_user }}</td>
                    </tr>

                    <tr>
                        <th>Nama User</th>
                        <td>{{ $user->nama_user }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>

                    <tr>
                        <th>Nomor HP</th>
                        <td>{{ $user->no_tlp }}</td>
                    </tr>

                    <tr>
                        <th>Role</th>
                        <td>{{ $user->role }}</td>
                    </tr>

                    <tr>
                        <th>Status</th>

                        <td>

                            <form action="{{ route('users.toggleStatus', $user->id) }}" method="POST">

                                @csrf
                                @method('PATCH')

                                <div class="form-check form-switch">

                                    <input class="form-check-input" type="checkbox" onchange="this.form.submit()"
                                        {{ $user->status == 'Active' ? 'checked' : '' }}>

                                </div>

                            </form>

                            <small>

                                {{ $user->status }}

                            </small>

                        </td>

                    </tr>

                    <tr>
                        <th>Dibuat</th>
                        <td>{{ $user->created_at }}</td>
                    </tr>

                    <tr>
                        <th>Diupdate</th>
                        <td>{{ $user->updated_at }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>
@endsection
