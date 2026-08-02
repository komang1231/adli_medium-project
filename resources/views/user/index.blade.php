@extends('layouts.app')

@section('template_title')
    Users
@endsection

@section('content')
    <div class="content-card">
        <div class="content-card">

            @if ($errors->any())
                <div class="alert alert-danger">

                    {{ $errors->first() }}

                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success">

                    {{ $message }}

                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h5>Data User</h5>

            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <button class="btn btn-add me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#formOffcanvas">

                        <img class="icon" src="{{ asset('assets/icons/table/add.svg') }}" alt="">

                        Add

                    </button>

                    <a href="{{ route('users.trash') }}" class="btn btn-trash">

                        <img class="icon" src="{{ asset('assets/icons/table/trash.svg') }}" alt="">

                        Trash

                    </a>

                </div>

                <div class="d-flex align-items-center">

                    <form action="{{ route('users.index') }}" method="GET" class="d-flex align-items-center">

                        <a href="{{ route('users.index', [
                            'search' => request('search'),
                            'sort' => $sort == 'asc' ? 'desc' : 'asc',
                        ]) }}"
                            class="sort-btn me-2 px-2 py-2">

                            <img src="{{ asset($sort == 'asc' ? 'assets/icons/table/sort_up.svg' : 'assets/icons/table/sort_down.svg') }}"
                                alt="Sort">

                        </a>
                        <x-filter-popup id="user-filter">
                            <x-filter-section label="Status" filter-key="status">
                                <x-filter-radio name="status" value="" :checked="$status == ''">

                                    Semua

                                </x-filter-radio>
                                <x-filter-radio name="status" value="Active" :checked="$status == 'Active'">Active</x-filter-radio>
                                <x-filter-radio name="status" value="Non-Active"
                                    :checked="$status == 'Non-Active'">Non-Active</x-filter-radio>
                            </x-filter-section>
                            <x-filter-section label="Role" filter-key="role">
                                <x-filter-radio name="role" value="Admin" :checked="$role == 'Admin'">Admin</x-filter-radio>
                                <x-filter-radio name="role" value="Manager" :checked="$role == 'Manager'">Manager</x-filter-radio>
                                <x-filter-radio name="role" value="Staff" :checked="$role == 'Staff'">Staff</x-filter-radio>
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

                            <th width="70">
                                No
                            </th>

                            <th>
                                Nama
                            </th>

                            <th>
                                Email
                            </th>

                            <th width="120">
                                Role
                            </th>

                            <th width="120">
                                Status
                            </th>

                            <th class="text-center" width="220">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)
                            <tr>

                                <td>

                                    {{ $users->firstItem() + $loop->index }}

                                </td>

                                <td>

                                    {{ $user->nama_user }}

                                </td>

                                <td>

                                    {{ $user->email }}

                                </td>

                                <td>

                                    {{ $user->role }}

                                </td>

                                <td>

                                    {{ $user->status }}

                                </td>

                                <td class="text-center">

                                    <a href="{{ route('users.show', $user->id) }}" class="btn-detail me-2">

                                        Detail

                                    </a>

                                    <button type="button" class="btn-edit btn-edit-user"
                                        data-action="{{ route('users.update', $user->id) }}"
                                        data-nama="{{ $user->nama_user }}" data-email="{{ $user->email }}"
                                        data-telp="{{ $user->no_tlp }}"
                                        data-foto="{{ $user->foto_profile ? asset('storage/' . $user->foto_profile) : '' }}">

                                        Edit

                                    </button>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-hapus ms-2"
                                            onclick="return confirm('Yakin ingin menghapus user ini?')">

                                            Hapus

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">

                                    Belum ada data user.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">

                <span class="entries-info">

                    Showing {{ $users->firstItem() ?? 0 }}

                    to {{ $users->lastItem() ?? 0 }}

                    of {{ $users->total() }} entries

                </span>

                {{ $users->withQueryString()->links() }}

            </div>

        </div>

        {{-- OFFCANVAS CREATE --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="formOffcanvas" aria-labelledby="formOffcanvasLabel">

            <div class="offcanvas-header">

                <span class="offcanvas-title" id="formOffcanvasLabel">

                    Create User

                </span>

                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas">
                </button>

            </div>

            <div class="offcanvas-body">

                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    @include('user.form')

                </form>

            </div>

        </div>


        {{-- OFFCANVAS EDIT --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="editUserOffcanvas"
            aria-labelledby="editUserOffcanvasLabel">

            <div class="offcanvas-header">

                <span class="offcanvas-title" id="editUserOffcanvasLabel">

                    Edit User

                </span>

                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas">
                </button>

            </div>

            <div class="offcanvas-body">

                <form id="editUserForm" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    @include('user.edit')

                </form>

            </div>

        </div>
    @endsection
