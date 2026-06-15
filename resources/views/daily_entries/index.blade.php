<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-100">Daily Entries</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">Your Daily Entries</h1>
                    <p class="text-sm text-gray-400 mt-1">Track your daily progress and creative work</p>
                </div>
                <a href="{{ route('daily_entries.create') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Entry
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-emerald-900/20 border border-emerald-700 text-emerald-400 text-sm rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($entries->isEmpty())
                <div class="text-center py-20 bg-gray-800 border border-gray-700 rounded-2xl shadow-sm">
                    <svg class="w-12 h-12 text-gray-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    <p class="text-gray-400 text-sm">No entries yet</p>
                    <a href="{{ route('daily_entries.create') }}" class="mt-4 inline-block text-indigo-400 text-sm font-medium hover:underline">Create your first entry →</a>
                </div>
            @else
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm overflow-hidden">
                    @foreach($entries as $entry)
                        @php
                            $score = $entry->quality_score;
                            $scoreLabel = match(true) {
                                $score === 2  => 'Great',
                                $score === 1  => 'Good',
                                $score === 0  => 'Neutral',
                                $score === -1 => 'Poor',
                                default       => 'Bad',
                            };
                            $scoreBadge = match(true) {
                                $score === 2  => 'bg-emerald-900/30 text-emerald-400 border border-emerald-700',
                                $score === 1  => 'bg-green-900/30 text-green-400 border border-green-700',
                                $score === 0  => 'bg-gray-700 text-gray-400 border border-gray-600',
                                $score === -1 => 'bg-amber-900/30 text-amber-400 border border-amber-700',
                                default       => 'bg-red-900/30 text-red-400 border border-red-700',
                            };
                            $metricCount = $entry->metricValues->count();
                        @endphp
                        <div class="px-6 py-4 {{ !$loop->last ? 'border-b border-gray-700' : '' }}">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    {{-- Date + badges row --}}
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <p class="text-sm font-semibold text-white">{{ \Carbon\Carbon::parse($entry->entry_date)->format('D, M j Y') }}</p>
                                        <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $scoreBadge }}">
                                            {{ $score > 0 ? '+' : '' }}{{ $score }} {{ $scoreLabel }}
                                        </span>
                                    </div>
                                    {{-- Stats row --}}
                                    <p class="text-xs text-gray-400 mt-1">
                                        <span class="font-medium text-indigo-400">{{ $entry->hours_creative_work }}h</span> creative work
                                        @if($metricCount > 0)
                                            · <span class="text-gray-500">{{ $metricCount }} metric{{ $metricCount > 1 ? 's' : '' }} logged</span>
                                        @endif
                                    </p>
                                    {{-- Notes snippet --}}
                                    @if($entry->notes)
                                        <p class="text-xs text-gray-500 mt-1 truncate max-w-md italic">"{{ $entry->notes }}"</p>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <a href="{{ route('daily_entries.edit', $entry) }}"
                                       class="px-3 py-1.5 text-xs font-medium text-gray-300 bg-gray-700 hover:bg-gray-600 rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('daily_entries.destroy', $entry) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 text-xs font-medium text-red-400 bg-red-900/20 hover:bg-red-900/30 rounded-lg transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
