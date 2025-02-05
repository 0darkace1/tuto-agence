@php
    $name ??= '';
    $label ??= ucFirst($name);
    $required ??= false;
    $class ??= null;
    $value ??= '';
    $multiple ??= true;
@endphp

<div @class(['form-group', $class])>
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}[]" @if ($multiple) multiple @endif>
        @foreach ($options as $k => $v)
            <option @selected($value->contains($k)) value="{{ $k }}">{{ $v }}</option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
