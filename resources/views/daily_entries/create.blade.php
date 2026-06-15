<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-100">Daily Entries</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-white">Create New Entry</h1>
                <p class="text-sm text-gray-400 mt-1">Log your daily progress</p>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">

                @if ($errors->any())
                    <div class="mb-5 px-4 py-3 bg-red-900/20 border border-red-700 text-red-400 text-sm rounded-lg">
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('daily_entries.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="entry_date" value="Date" />
                        <x-text-input id="entry_date" type="date" name="entry_date" class="mt-1 block w-full" :value="old('entry_date')" required />
                        <x-input-error :messages="$errors->get('entry_date')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="hours_creative_work" value="Hours of Creative Work" />
                        <x-text-input id="hours_creative_work" type="number" name="hours_creative_work" class="mt-1 block w-full" :value="old('hours_creative_work')" min="0" max="24" step="1" required />
                        <x-input-error :messages="$errors->get('hours_creative_work')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="quality_score" value="Quality Score (−2 to 2)" />
                        <x-text-input id="quality_score" type="number" name="quality_score" class="mt-1 block w-full" :value="old('quality_score')" min="-2" max="2" step="1" required />
                        <x-input-error :messages="$errors->get('quality_score')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="notes" value="Notes" />
                        <textarea id="notes" name="notes" rows="3"
                            class="mt-1 block w-full bg-gray-700 border border-gray-600 text-gray-100 placeholder-gray-500 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 transition">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-1" />
                    </div>

                    @if($metrics->count() > 0)
                        <div class="pt-4 border-t border-gray-700">
                            <p class="text-sm font-semibold text-gray-300 mb-4">Custom Metrics</p>
                            <div class="space-y-4">
                                @foreach($metrics as $metric)
                                    <div>
                                        <x-input-label :value="$metric->name" />
                                        <x-text-input type="number" name="metrics[{{ $metric->id }}]" class="mt-1 block w-full" :value="old('metrics.' . $metric->id)" step="1" min="0" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="pt-2 flex gap-3">
                        <x-primary-button>Save Entry</x-primary-button>
                        <a href="{{ route('daily_entries.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-gray-600 text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-600 transition">Cancel</a>
                    </div>
                </form>            </div>
        </div>
    </div>
</x-app-layout>
