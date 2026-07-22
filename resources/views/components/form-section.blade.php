@props(['title', 'description' => null])

<section class="space-y-4">
    <header>
        <h2 class="text-lg font-medium text-white">{{ $title }}</h2>
        @if($description)
            <p class="mt-1 text-sm text-gray-400">{{ $description }}</p>
        @endif
    </header>

    {{ $slot }}
</section>
