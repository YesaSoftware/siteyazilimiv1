<div class="form-group mb-3">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control"
           value="{{ old($name, $value) }}"
           @if($required) required @endif
           @if($disabled) disabled @endif
           @if($readonly) readonly @endif
           @if(!$autocomplete)
               autocomplete="off"
           @else
               autocomplete="on"
           @endif
    >
</div>
