@props(['label', 'name', 'type' => 'text', 'value' => '', 'required' => false])

<div class="mb-4">
    <label for="{{ $name }}" class="block font-semibold mb-1">{{ $label }}</label>
    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $name }}"
           value="{{ old($name, $value) }}"
           @if($required) required @endif
           {{ $attributes->merge(['class' => 'w-full border px-4 py-2 rounded focus:ring focus:outline-none']) }}>
</div>
