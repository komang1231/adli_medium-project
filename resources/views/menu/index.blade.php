@extends('layouts.app')

@section('template_title')
    Menus
@endsection

@section('content')
    <div class="content-card">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5>Data Menu</h5>
        </div>

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
            <div>
                <a class="btn btn-add me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#formOffcanvas">

                    <img class="icon" src="{{ asset('assets/icons/table/add.svg') }}" alt="">
                    Add

                </a>
                <a href="{{ route('menus.trash') }}" class="btn btn-trash">

                    <img class="icon" src="{{ asset('assets/icons/table/trash.svg') }}" alt="">

                    Trash

                </a>
            </div>

            <div class="d-flex align-items-center">
                <form action="{{ route('menus.index') }}" method="GET" class="d-flex align-items-center">
                    <a href="{{ route('menus.index', [
                        'search' => request('search'),
                        'kategori' => request('kategori'),
                        'stok' => request('stok'),
                        'sort' => $sort == 'asc' ? 'desc' : 'asc',
                    ]) }}"
                        class="sort-btn me-2 px-2 py-2">

                        <img src="{{ asset($sort == 'asc' ? 'assets/icons/table/sort_up.svg' : 'assets/icons/table/sort_down.svg') }}"
                            alt="Sort">

                    </a>

                    <x-filter-popup id="menu-filter">

                        <x-filter-section label="Kategori" filter-key="kategori">
                            <select name="kategori" class="filter-select">
                                <option value="" {{ request('kategori') == '' ? 'selected' : '' }}>Semua</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('kategori') == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama_category }}
                                    </option>
                                @endforeach
                            </select>
                        </x-filter-section>

                        <x-filter-section label="Stok" filter-key="stok">

                            <x-filter-radio name="stok" value="" :checked="request('stok', '') == ''">
                                Semua
                            </x-filter-radio>

                            <x-filter-radio name="stok" value="available" :checked="request('stok') == 'available'">
                                Tersedia
                            </x-filter-radio>

                            <x-filter-radio name="stok" value="empty" :checked="request('stok') == 'empty'">
                                Habis
                            </x-filter-radio>

                        </x-filter-section>

                    </x-filter-popup>


                    <x-search-bar :route="route('menus.index')" placeholder="Cari..." />

                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="20">No</th>
                        <th width="140">Kode Menu</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        {{-- <th width="20" padding-right="150"></th> --}}
                        <th>Kategori</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($menus as $menu)
                        <tr>
                            <td>{{ $menus->firstItem() + $loop->index }}</td>
                            <td>{{ $menu->kode_menu }}</td>
                            <td>{{ $menu->nama_menu }}</td>
                            <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                            <td>{{ $menu->stok }} {{ $menu->satuan }}</td>
                            {{-- <td>{{ $menu->satuan }}</td> --}}
                            <td>{{ $menu->category->nama_category ?? '-' }}</td>

                            <td class="text-center">
                                <button type="button" class="btn-detail btn-detail-button"
                                    data-bs-toggle="offcanvas" data-bs-target="#detailMenuOffcanvas"
                                    data-action="{{ route('menus.show', $menu->id) }}"
                                    data-nama="{{ $menu->nama_menu }}" data-harga="{{ $menu->harga }}"
                                    data-stok="{{ $menu->stok }}" data-satuan="{{ $menu->satuan }}" data-category="{{ $menu->category->nama_category ?? '-' }}"
                                    data-foto="{{ $menu->foto_menu ? asset('storage/' . $menu->foto_menu) : '' }}">

                                    <i class="bi bi-eye"></i>

                                </button>
                                <button type="button" class="btn-edit btn-edit-menu me-1" onclick="return confirm('Yakin ingin mengedit menu ini?')" data-bs-toggle="offcanvas" data-bs-target="#editMenuOffcanvas"
                                    data-action="{{ route('menus.update', $menu->id) }}"
                                    data-nama="{{ $menu->nama_menu }}" data-harga="{{ $menu->harga }}"
                                    data-stok="{{ $menu->stok }}" data-satuan="{{ $menu->satuan }}" data-category="{{ $menu->category_id }}"
                                    data-foto="{{ $menu->foto_menu ? asset('storage/' . $menu->foto_menu) : '' }}">

                                    <i class="bi bi-pencil-square"></i>

                                </button>

                                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-hapus"
                                        onclick="return confirm('Yakin ingin menghapus menu ini?')">

                                        <i class="bi bi-trash"></i>

                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                Belum ada data menu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">

            <span class="entries-info">
                Showing {{ $menus->firstItem() ?? 0 }}
                to {{ $menus->lastItem() ?? 0 }}
                of {{ $menus->total() }} entries
            </span>

            {{ $menus->withQueryString()->links() }}
        </div>

    </div>

    {{-- OFF CANVAS CREATE --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="formOffcanvas" aria-labelledby="formOffcanvasLabel">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="formOffcanvasLabel">{{ __('Create') }} Menu</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="form-add-menu" method="POST" action="{{ route('menus.store') }}" role="form" enctype="multipart/form-data">
                @csrf

                @include('menu.form')

            </form>
        </div>
    </div>

    {{-- OFF CANVAS EDIT --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editMenuOffcanvas" aria-labelledby="editMenuOffcanvasLabel">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="editMenuOffcanvasLabel">{{ __('Edit') }} Menu</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="editMenuForm" method="POST" action="" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @include('menu.edit')

            </form>
        </div>
    </div>

    {{-- OFF CANVAS DETAIL --}}
    <div class="offcanvas offcanvasDetail offcanvas-end" tabindex="-1" id="detailMenuOffcanvas" aria-labelledby="detailMenuOffcanvasLabel">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="detailMenuOffcanvasLabel">{{ __('Detail') }} Menu</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="detailMenuForm" method="POST" action="" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @include('menu.show')

            </form>
        </div>
    </div>
    {{-- MODAL EDIT --}}
    <x-modal.action-modal id="editMenuModal" title="Edit Menu" buttonText="Lanjutkan" buttonClass="btn-edit">

        Apakah kamu yakin ingin mengubah menu

        <strong id="editMenuName"></strong> ?

    </x-modal.action-modal>

    {{-- MODAL HAPUS --}}
    <x-modal.action-modal id="deleteMenuModal" title="Hapus Menu" buttonText="Hapus" buttonClass="btn-hapus">

        Apakah kamu yakin ingin menghapus menu

        <strong id="deleteMenuName"></strong> ?

    </x-modal.action-modal>
@endsection
