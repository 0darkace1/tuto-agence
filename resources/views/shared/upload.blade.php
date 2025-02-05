@php
    $name ??= '';
    $label ??= ucFirst($name);
    $required ??= false;
    $disabled ??= false;
    $multiple ??= false;
    $class ??= null;
    $value ??= '';
@endphp

<div @class(['form-group', $class])>
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>


    <input id="{{ $name }}" name="{{ $name . ($multiple ? '[]' : '') }}" type="file"
        class="form-control @error($name) is-invalid @enderror" placeholder="{{ $label }}"
        value="{{ old($name, $value) }}" @if ($required) required @endif
        @if ($disabled) disabled @endif @if ($multiple) multiple @endif>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
