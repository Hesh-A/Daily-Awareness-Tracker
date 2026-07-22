<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            View Entry
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 px-4 text-gray-100">

        <div class="bg-gray-800 border border-gray-700 rounded p-6">

            <h3 class="text-2xl font-semibold mb-4">
                {{ \Carbon\Carbon::parse($entry->entry_date)->format('F j, Y') }}
            </h3>

            <div class="space-y-3 mb-6">
                <p><span class="text-gray-400">Hours:</span> {{ $entry->hours_creative_work }}</p>
                <p><span class="text-gray-400">Quality:</span> {{ $entry->quality_score }}</p>
                <p><span class="text-gray-400">Notes:</span> {{ $entry->notes ?: '—' }}</p>
            </div>

            @if ($entry->metricValues->count())
                <div class="border-t border-gray-700 pt-4">
                    <h4 class="text-lg font-semibold mb-3">Custom Metrics</h4>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($entry->metricValues as $metricValue)
                            <div class="bg-gray-700 p-3 rounded">
                                <p class="text-gray-400 text-sm">{{ $metricValue->customMetric->name }}</p>
                                <p class="text-lg">{{ $metricValue->value }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mt-8 flex justify-between">

                <a href="{{ route('daily-entries.index') }}"
                   class="text-blue-400 hover:underline">
                    Back to Entries
                </a>

                <div class="space-x-4">
                    <a href="{{ route('daily-entries.edit', $entry) }}"
                       class="text-yellow-400 hover:underline">
                        Edit
                    </a>

                    <form action="{{ route('daily-entries.destroy', $entry) }}"
                          method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-400 hover:underline"
                                onclick="return confirm('Delete this entry?')">
                            Delete
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>
