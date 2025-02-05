@php
    $name ??= '';
    $label ??= ucFirst($name);
    $type ??= 'text';
    $required ??= false;
    $disabled ??= false;
    $class ??= null;
    $value ??= '';
@endphp

<div @class(['form-group', $class])>
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    @if ($type === 'textarea')
        <textarea id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
            class="form-control @error($name) is-invalid @enderror" placeholder="{{ $label }}"
            @if ($required) required @endif @if ($disabled) disabled @endif>{{ old($name, $value) }}</textarea>
    @else
        <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
            class="form-control @error($name) is-invalid @enderror" placeholder="{{ $label }}"
            value="{{ old($name, $value) }}" @if ($required) required @endif
            @if ($disabled) disabled @endif>
    @endif
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
