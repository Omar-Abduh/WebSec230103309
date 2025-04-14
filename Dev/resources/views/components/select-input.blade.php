@props([
    'options' => [],
    'selected' => null,
    'placeholder' => null,
])

<select
    {{ $attributes->merge(['class' => 'mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}>
    @if ($placeholder)
        <option value=""  {{ is_null($selected) ? 'selected' : '' }}>{{ $placeholder }}</option>
    @endif

    @foreach ($options as $key => $value)
        <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>
            {{ $value }}
        </option>
    @endforeach
</select>
