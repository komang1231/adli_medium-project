@props([
    'name',
    'value',
    'checked' => false,
])

<label class="filter-radio-row">
    <input type="radio" name="{{ $name }}" value="{{ $value }}" @checked($checked)>
    <span class="filter-radio-dot" aria-hidden="true"></span>
    <span class="filter-radio-label">{{ $slot }}</span>
</label>
