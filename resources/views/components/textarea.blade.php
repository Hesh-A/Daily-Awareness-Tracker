@props(['disabled' => false])

<textarea
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'mt-1 block w-full bg-gray-700 border border-gray-600 rounded text-gray-100 p-2 focus:border-indigo-500 focus:ring-indigo-500']) }}
>{{ $slot }}
</textarea>
