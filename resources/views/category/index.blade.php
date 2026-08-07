@extends('layouts.app')

@section('template_title')
    Categories
@endsection

@section('content')
    <div class="content-card">
        @if ($errors->any())
            <div class="alert alert-danger">

                {{ $errors->first() }}

            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
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
                        class="sort-btn me-2 px-2 py-2">

                        <img src="{{ asset($sort == 'asc' ? 'assets/icons/table/sort_up.svg' : 'assets/icons/table/sort_down.svg') }}"
                            alt="Sort">

                    </a>

                    <x-filter-popup id="category-filter">

                        <x-filter-section label="Digunakan" filter-key="used">

                            <x-filter-radio name="used" value="" :checked="$used == ''">
                                Semua
                            </x-filter-radio>

                            <x-filter-radio name="used" value="yes" :checked="$used == 'yes'">
                                Digunakan
                            </x-filter-radio>

                            <x-filter-radio name="used" value="no" :checked="$used == 'no'">
                                Tidak Digunakan
                            </x-filter-radio>

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
                        <thead>
                            <tr>
                                <th width="20">No</th>
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
                                <button type="button" class="btn-edit btn-edit-category me-2" data-id="{{ $category->id }}"
                                    data-name="{{ $category->nama_category }}"
                                    data-action="{{ route('categories.update', $category->id) }}"
                                    data-used="{{ $category->menus_count }}"> 
                                    <i class="bi bi-pencil-square"></i> 
                                </button>


                                <button type="button" class="btn-hapus btn-delete-category ms-2"
                                    data-id="{{ $category->id }}" data-name="{{ $category->nama_category }}"
                                    data-action="{{ route('categories.destroy', $category->id) }}"
                                    data-used="{{ $category->menus_count }}">
                                    <i class="bi bi-trash"></i>

                                </button>
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

    {{-- OFF CANVAS CREATE --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="formOffcanvas" aria-labelledby="formOffcanvasLabel">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="formOffcanvasLabel">{{ __('Create') }} Category</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="form-add-category" method="POST" action="{{ route('categories.store') }}" role="form" enctype="multipart/form-data">
                @csrf

                @include('category.form')

            </form>
        </div>
    </div>

    {{-- OFF CANVAS EDIT --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editCategoryOffcanvas" aria-labelledby="formOffcanvasLabel">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="formOffcanvasLabel">{{ __('Create') }} Category</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="editForm" method="POST" action="" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @include('category.edit')

            </form>
        </div>
    </div>


    {{-- MODAL EDIT --}}
    <x-modal.action-modal id="editCategoryModal" title="Edit Kategori" buttonText="Lanjutkan" buttonClass="btn-submit">

        Apakah kamu yakin ingin mengubah kategori

        <strong id="editCategoryName"></strong> ?

    </x-modal.action-modal>

    {{-- MODAL HAPUS --}}
    <x-modal.action-modal id="deleteCategoryModal" title="Hapus Kategori" buttonText="Hapus" buttonClass="btn-submit">

        Apakah kamu yakin ingin menghapus kategori

        <strong id="deleteCategoryName"></strong> ?

    </x-modal.action-modal>

    <x-modal.warning-modal id="warningCategoryModal" title="Tidak Dapat Menghapus">

        Kategori

        <strong id="warningCategoryName"></strong>

        sedang digunakan oleh

        <strong id="warningCategoryCount"></strong>

        menu.

    </x-modal.warning-modal>
    
@endsection
