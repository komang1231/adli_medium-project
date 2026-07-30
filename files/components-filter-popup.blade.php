@props(['id'])

<div class="filter-widget" data-filter-widget>

    <button type="button" class="btn-filter" data-filter-trigger id="{{ $id }}-trigger" aria-haspopup="true"
        aria-expanded="false" aria-controls="{{ $id }}-popup">
        <img src="{{ asset('assets/icons/table/filter.svg') }}">
        <span>Filter</span>
        <span class="filter-dot" data-filter-dot aria-hidden="true"></span>
    </button>

    <div class="filter-popup" data-filter-popup id="{{ $id }}-popup" role="dialog"
        aria-labelledby="{{ $id }}-title" hidden>

        {{-- <div class="filter-popup-header" id="{{ $id }}-title">
            Filter
        </div> --}}
        <header class="filter-popup-header" id="{{ $id }}-title">

            <h6 class="filter-title">
                Filter
            </h6>

            <button type="button" class="btn-filter-close" data-filter-close>

                <i class="bi bi-x-lg"></i>

            </button>

        </header>

        <div class="filter-popup-body" data-filter-body data-filter-content>

            {{ $slot }}

        </div>

        <footer class="filter-popup-footer">
            <button type="button" class="btn-filter-reset" data-filter-reset data-filter-reset>
                {{ __('Reset') }}
            </button>
            <button type="button" class="btn-filter-apply" data-filter-apply>
                {{ __('Terapkan') }}
            </button>
        </footer>

    </div>
</div>
