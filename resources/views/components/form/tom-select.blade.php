@props([
    'id',
    'name',
    'options' => [],
    'selected' => null,
    'placeholder' => 'Pilih data',
    'valueField' => 'id',
    'labelField' => 'nama_category'
])

<select
    id="{{ $id }}"
    name="{{ $name }}"
    class="form-select tom-select">

    <option value="">
        {{ $placeholder }}
    </option>

    @foreach($options as $option)

        <option
            value="{{ $option->$valueField }}"
            @selected($selected == $option->$valueField)>

            {{ $option->$labelField }}

        </option>

    @endforeach

</select>