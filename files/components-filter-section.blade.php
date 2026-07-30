@props([
    'label',
    'filterKey',
])

<div class="filter-section"
     data-filter-key="{{ $filterKey }}">

    <div class="filter-section-label">
        {{ $label }}
    </div>

    {{ $slot }}

</div>