<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-100">Custom Metrics</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-white">Add New Metric</h1>
                <p class="text-sm text-gray-400 mt-1">Create a custom metric to track</p>
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

                <form action="{{ route('custom_metrics.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="name" value="Metric Name" />
                        <x-text-input id="name" type="text" name="name" class="mt-1 block w-full" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div class="pt-2 flex gap-3">
                        <x-primary-button>Save Metric</x-primary-button>
                        <a href="{{ route('custom_metrics.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-gray-600 text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-600 transition">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
