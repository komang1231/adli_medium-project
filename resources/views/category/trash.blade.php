@extends('layouts.app')

@section('template_title')
    Trash Categories
@endsection

@section('content')
    <div class="content-card">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5>Data Kategori Terhapus</h5>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('categories.index') }}" class="btn btn-add">
                    <img class="icon" src="{{ asset('assets/icons/table/back.svg') }}" alt="">
                    Back
                </a>
            </div>

            <div class="d-flex align-items-center">
                <a href="{{ route('categories.trash', [
                    'search' => request('search'),
                    'sort' => $sort == 'asc' ? 'desc' : 'asc',
                ]) }}"
                    class="sort-btn me-3 px-2 py-2">

                    <img src="{{ asset($sort == 'asc' ? 'assets/icons/table/sort_up.svg' : 'assets/icons/table/sort_down.svg') }}"
                        alt="Sort">

                </a>

                <form action="{{ route('categories.trash') }}" method="GET" class="d-flex align-items-center">

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
                        <th width="20">No</th>
                        <th width="140">Kode</th>
                        <th>Nama Kategori</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $categories->firstItem() + $loop->index }}</td>
                            <td>{{ $category->kode_category }}</td>
                            <td>{{ $category->nama_category }}</td>

                            <td class="text-center">

                                <form action="{{ route('categories.restore', $category->id) }}" method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('PATCH')

                                    <button type="button" class="btn-restore btn-restore-category"
                                        data-name="{{ $category->nama_category }}"
                                        data-action="{{ route('categories.restore', $category->id) }}">

                                        Restore

                                    </button>

                                </form>

                                <form action="{{ route('categories.forceDelete', $category->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-hapus"
                                        onclick="return confirm('Yakin ingin menghapus permanen kategori ini?')">

                                        Delete

                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                Belum ada data kategori yang dihapus.
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
