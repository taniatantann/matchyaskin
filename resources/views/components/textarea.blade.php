@props(['label', 'name', 'rows' => 3])

<div class="mb-4">
    <label for="{{ $name }}" class="block font-semibold mb-1">{{ $label }}</label>
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        {{ $attributes->merge(['class' => 'w-full border px-4 py-2 rounded focus:ring focus:outline-none']) }}
    >{{ old($name, $slot) }}</textarea>
</div>
