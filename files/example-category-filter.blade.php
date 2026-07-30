<x-filter-popup id="category-filter">

    <x-filter-section label="Digunakan" filter-key="digunakan">
        <x-filter-radio name="digunakan" value="all" :checked="true">Semua</x-filter-radio>
        <x-filter-radio name="digunakan" value="used">Digunakan</x-filter-radio>
        <x-filter-radio name="digunakan" value="unused">Tidak Digunakan</x-filter-radio>
    </x-filter-section>

</x-filter-popup>
