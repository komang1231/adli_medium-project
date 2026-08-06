<div class="content-card">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h5>Detail Menu</h5>

    </div>

    {{-- Foto --}}
    <div class="text-center mb-4">

        @if ($menu->foto_menu)
            <img src="{{ asset('storage/' . $menu->foto_menu) }}" class="menu-detail-image">
        @else
            <div class="menu-no-image">

                No Image

            </div>
        @endif

    </div>

    {{-- Detail --}}
    <table class="table table-borderless">

        <tr>
            <th width="220">Kode Menu</th>
            <td>{{ $menu->kode_menu }}</td>
        </tr>

        <tr>
            <th>Nama Menu</th>
            <td>{{ $menu->nama_menu }}</td>
        </tr>

        <tr>
            <th>Harga</th>
            <td>Rp{{ number_format($menu->harga, 0, ',', '.') }}</td>
        </tr>

        <tr>
            <th>Stok</th>
            <td>{{ $menu->stok }}</td>
        </tr>

        <tr>
            <th>Kategori</th>
            <td>{{ $menu->category->nama_category }}</td>
        </tr>

        <tr>
            <th>Dibuat</th>
            <td>{{ $menu->created_at->format('d M Y H:i') }}</td>
        </tr>

        <tr>
            <th>Diubah</th>
            <td>{{ $menu->updated_at->format('d M Y H:i') }}</td>
        </tr>

    </table>

    {{-- Tombol --}}
    <div class="text-end mt-4">

        {{-- <button class="btn btn-edit">

            <i class="bi bi-pencil-square me-2"></i>

        </button> --}}
        <button type="button" class="btn-edit btn-edit-menu me-1"
            onclick="return confirm('Yakin ingin mengedit menu ini?')" data-bs-toggle="offcanvas"
            data-bs-target="#editMenuOffcanvas" data-action="{{ route('menus.update', $menu->id) }}"
            data-nama="{{ $menu->nama_menu }}" data-harga="{{ $menu->harga }}" data-stok="{{ $menu->stok }}"
            data-satuan="{{ $menu->satuan }}" data-category="{{ $menu->category_id }}"
            data-foto="{{ $menu->foto_menu ? asset('storage/' . $menu->foto_menu) : '' }}">

            <i class="bi bi-pencil-square"></i>

        </button>

        {{-- <button class="btn btn-hapus ms-2">

            <i class="bi bi-trash me-2"></i>

        </button> --}}
        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus menu ini?')">

                <i class="bi bi-trash"></i>

            </button>
        </form>

    </div>

</div>
