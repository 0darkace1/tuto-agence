@php
    $name ??= '';
    $label ??= ucFirst($name);
    $required ??= false;
    $class ??= null;
    $value ??= '';
@endphp

<div @class(['form-check form-switch', $class])>
    <label for="{{ $name }}" class="form-check-label">{{ $label }}</label>
    <input name="{{ $name }}" type="hidden" value="0">
    <input @checked(old($value, $value ?? false)) id="{{ $name }}" name="{{ $name }}" type="checkbox" value="1"
        class="form-check-input @error($name) is-invalid @enderror" role="switch">
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
