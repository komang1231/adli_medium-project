@extends('layouts.app')

@section('template_title')
    Categories
@endsection

@section('content')
    <div class="content-card">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5>Data Kategori</h5>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('categories.create') }}" class="btn btn-add me-2" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#formOffcanvas" aria-controls="formOffcanvas">
                    <img class="icon" src="{{ asset('assets/icons/table/add.svg') }}" alt="">
                    Add
                </a>
                {{-- <button class="btn btn-add mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#formOffcanvas"
                    aria-controls="formOffcanvas">
                    <i class="bi bi-plus-circle"></i> {{ __('Create') }} Category
                </button> --}}
                <a href="{{ route('categories.trash') }}" class="btn btn-trash">
                    <img class="icon" src="{{ asset('assets/icons/table/trash.svg') }}" alt="">
                    Trash
                </a>
            </div>

            <div class="d-flex align-items-center">
                <form action="{{ route('categories.index') }}" method="GET" class="d-flex align-items-center">
                    <a href="{{ route('categories.index', [
                        'search' => request('search'),
                        'used' => request('used'),
                        'sort' => $sort == 'asc' ? 'desc' : 'asc',
                    ]) }}"
                        class="sort-btn me-3 px-2 py-2">

                        <img src="{{ asset($sort == 'asc' ? 'assets/icons/table/sort_up.svg' : 'assets/icons/table/sort_down.svg') }}"
                            alt="Sort">

                    </a>

                    <select name="used" class="form-select filter-select me-3" onchange="this.form.submit()">

                        <option value="">Semua</option>

                        <option value="yes" {{ request('used') == 'yes' ? 'selected' : '' }}>
                            Digunakan
                        </option>

                        <option value="no" {{ request('used') == 'no' ? 'selected' : '' }}>
                            Tidak Digunakan
                        </option>

                    </select>



                    <input type="text" name="search" class="form-control search-box" placeholder="Cari..."
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
                        <thead>
                            <tr>
                                <th width="70">No</th>
                                <th width="140">Kode</th>
                                <th>Nama Kategori</th>
                                <th>Digunakan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $categories->firstItem() + $loop->index }}</td>
                            <td>{{ $category->kode_category }}</td>
                            <td>{{ $category->nama_category }}</td>
                            <td>{{ $category->menus_count }}</td>

                            <td class="text-center">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn-edit ms-2">
                                    Edit
                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-hapus ms-2">
                                        Hapus
                                    </button>

                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                Belum ada data kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">

            <span class="entries-info">
                Showing {{ $categories->firstItem() ?? 0 }}
                to {{ $categories->lastItem() ?? 0 }}
                of {{ $categories->total() }} entries
            </span>

            {{ $categories->links() }}
        </div>

    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="formOffcanvas" aria-labelledby="formOffcanvasLabel">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="formOffcanvasLabel">{{ __('Create') }} Category</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="POST" action="{{ route('categories.store') }}" role="form" enctype="multipart/form-data">
                @csrf

                @include('category.form')

            </form>
        </div>
    </div>
@endsection
