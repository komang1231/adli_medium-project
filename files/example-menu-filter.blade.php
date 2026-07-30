<x-filter-popup id="menu-filter">

    <x-filter-section label="Kategori" filter-key="kategori">
        <select name="kategori" class="filter-select">
            <option value="all" selected>Semua</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->nama_category }}</option>
            @endforeach
        </select>
    </x-filter-section>

    <x-filter-section label="Status" filter-key="status">
        <x-filter-radio name="status" value="all" :checked="true">Semua</x-filter-radio>
        <x-filter-radio name="status" value="active">Active</x-filter-radio>
        <x-filter-radio name="status" value="non_active">Non Active</x-filter-radio>
    </x-filter-section>

    <x-filter-section label="Stok" filter-key="stok">
        <x-filter-radio name="stok" value="all" :checked="true">Semua</x-filter-radio>
        <x-filter-radio name="stok" value="available">Tersedia</x-filter-radio>
        <x-filter-radio name="stok" value="empty">Habis</x-filter-radio>
    </x-filter-section>

</x-filter-popup>
