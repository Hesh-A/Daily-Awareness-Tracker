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
                        <div class="flex items-center justify-between px-6 py-4 {{ !$loop->last ? 'border-b border-gray-700' : '' }}">
                            <div>
                                <p class="text-sm font-semibold text-white">{{ \Carbon\Carbon::parse($entry->entry_date)->format('D, M j Y') }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    {{ $entry->hours_creative_work }}h creative · Quality: {{ $entry->quality_score > 0 ? '+' : '' }}{{ $entry->quality_score }}
                                </p>
                            </div>
                            <div class="flex items-center gap-2">
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
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
