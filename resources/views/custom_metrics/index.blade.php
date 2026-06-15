<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-100">Custom Metrics</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">Your Metrics</h1>
                    <p class="text-sm text-gray-400 mt-1">Manage custom metrics for your entries</p>
                </div>
                <a href="{{ route('custom_metrics.create') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Metric
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-emerald-900/20 border border-emerald-700 text-emerald-400 text-sm rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($metrics->isEmpty())
                <div class="text-center py-20 bg-gray-800 border border-gray-700 rounded-2xl shadow-sm">
                    <svg class="w-12 h-12 text-gray-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <p class="text-gray-400 text-sm">No metrics yet</p>
                    <a href="{{ route('custom_metrics.create') }}" class="mt-4 inline-block text-indigo-400 text-sm font-medium hover:underline">Add your first metric →</a>
                </div>
            @else
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm overflow-hidden">
                    @foreach($metrics as $metric)
                        <div class="flex items-center justify-between px-6 py-4 {{ !$loop->last ? 'border-b border-gray-700' : '' }}">
                            <span class="text-sm font-medium text-gray-200">{{ $metric->name }}</span>
                            <form action="{{ route('custom_metrics.destroy', $metric) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 text-xs font-medium text-red-400 bg-red-900/20 hover:bg-red-900/30 rounded-lg transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
