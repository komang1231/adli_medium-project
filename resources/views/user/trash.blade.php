@extends('layouts.app')

@section('template_title')
    Trash User
@endsection

@section('content')

<div class="content-card">

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h5>Trash User</h5>

    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <a
                href="{{ route('users.index') }}"
                class="btn btn-add">

                Kembali

            </a>

        </div>

        <div class="d-flex align-items-center">

            <form
                action="{{ route('users.trash') }}"
                method="GET"
                class="d-flex align-items-center">

                <a
                    href="{{ route('users.trash',[
                        'search'=>request('search'),
                        'sort'=>$sort=='asc'?'desc':'asc'
                    ]) }}"
                    class="sort-btn me-2 px-2 py-2">

                    <img
                        src="{{ asset($sort=='asc'
                            ? 'assets/icons/table/sort_up.svg'
                            : 'assets/icons/table/sort_down.svg') }}"
                        alt="">

                </a>

                <input
                    type="text"
                    name="search"
                    class="search-box"
                    placeholder="Cari..."
                    value="{{ request('search') }}">

                <button
                    class="search-icon-btn">

                    <img
                        src="{{ asset('assets/icons/table/search.svg') }}"
                        alt="">

                </button>

            </form>

        </div>

    </div>

    <div class="table-responsive">

        <table class="table">

            <thead>

                <tr>

                    <th width="20">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="text-center" width="230">Aksi</th>

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

                            <form
                                action="{{ route('users.restore',$user->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('PATCH')

                                <button
                                    class="btn-edit">

                                    Restore

                                </button>

                            </form>

                            <form
                                action="{{ route('users.forceDelete',$user->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn-hapus ms-2"
                                    onclick="return confirm('User akan dihapus permanen. Lanjutkan?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            Trash kosong.

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

@endsection