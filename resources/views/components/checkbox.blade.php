@props(['label', 'name', 'checked' => false])

<div class="flex items-center space-x-2">
    <input type="checkbox"
           name="{{ $name }}"
           id="{{ $name }}"
           value="1"
           {{ old($name, $checked) ? 'checked' : '' }}
           {{ $attributes->merge(['class' => 'h-4 w-4 text-blue-600 border-gray-300 rounded']) }}>

    <label for="{{ $name }}" class="text-sm text-gray-700">{{ $label }}</label>
</div>
