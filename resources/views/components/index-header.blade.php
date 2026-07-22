@props(['title', 'description', 'addLabel', 'addRoute'])

<div class="flex justify-between items-center mb-8">
    <header>
        <h2 class="text-lg font-medium text-white">{{ $title }}</h2>
        <p class="mt-1 text-sm text-gray-400">{{ $description }}</p>
    </header>

    <a href="{{ $addRoute }}"
       class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white">
        {{ $addLabel }}
    </a>
</div>
