@extends('layouts.app')

@section('template_title')
    Trash Categories
@endsection

@section('content')
    <div class="content-card">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5>Data Menu Terhapus</h5>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('menus.index') }}" class="btn btn-add">
                    <img class="icon" src="{{ asset('assets/icons/table/back.svg') }}" alt="">
                    Back
                </a>
            </div>

            <div class="d-flex align-items-center">
                <a href="{{ route('menus.trash', [
                    'search' => request('search'),
                    'sort' => $sort == 'asc' ? 'desc' : 'asc',
                ]) }}"
                    class="sort-btn me-3 px-2 py-2">

                    <img src="{{ asset($sort == 'asc' ? 'assets/icons/table/sort_up.svg' : 'assets/icons/table/sort_down.svg') }}"
                        alt="Sort">

                </a>

                <form action="{{ route('menus.trash') }}" method="GET" class="d-flex align-items-center">

                    <x-search-bar :route="route('menus.trash')" placeholder="Cari..." />

                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="70">No</th>
                        <th width="140">Kode Menu</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        {{-- <th>Foto Menu</th> --}}
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
                            <td>{{ $menu->stok }}</td>
                            <td>{{ $menu->category->nama_category ?? '-' }}</td>

                            <td class="text-center2">

                                <form action="{{ route('menus.restore', $menu->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn-restore btn-restore-menu me-2"
                                        onclick="return confirm('Restore menu ini?')">

                                        Restore

                                    </button>
                                </form>

                                <form action="{{ route('menus.forceDelete', $menu->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-hapus"
                                        onclick="return confirm('Hapus permanen menu ini?')">

                                        Delete

                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">
                                Belum ada data menu yang dihapus.
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

            {{ $menus->links() }}

        </div>

    </div>

    <x-modal.action-modal id="restoreCategoryModal" title="Restore Category" buttonText="Restore" buttonClass="btn-submit">

        Apakah kamu yakin ingin me-restore kategori
        <strong id="restoreCategoryName"></strong>?

    </x-modal.action-modal>


    <x-modal.action-modal id="forceDeleteCategoryModal" title="Delete Permanently" buttonText="Delete"
        buttonClass="btn-submit">

        Apakah kamu yakin ingin menghapus permanen kategori
        <strong id="forceDeleteCategoryName"></strong>?

    </x-modal.action-modal>
@endsection
