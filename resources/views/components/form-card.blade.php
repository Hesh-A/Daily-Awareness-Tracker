@props(['maxWidth' => 'max-w-2xl'])

<div class="p-4 sm:p-8 bg-gray-800 border border-gray-700 shadow sm:rounded-lg">
    <div class="{{ $maxWidth }} mx-auto">
        {{ $slot }}
    </div>
</div>
