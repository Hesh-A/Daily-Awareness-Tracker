<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-gray-800 border border-gray-700 shadow sm:rounded-lg">
                <div class="max-w-2xl mx-auto space-y-6">

                    <section class="space-y-4">
                        <header class="mb-8">
                            <h2 class="text-lg font-medium text-white">Daily Overview</h2>
                            <p class="mt-1 text-sm text-gray-600">
                                Overview of your latest entry's metrics for the date {{ $latestEntry->entry_date ?? ''}}.
                            </p>
                        </header>

                        @if ($latestEntry)
                         <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                          {{-- Hours of Creative Work --}}
                          @include('dashboard.partials.metric-card', [
                          'label' => 'Hours of Creative Work',
                          'value' => $latestEntry->hours_creative_work,
                          'max' => 24
                         ])

                            {{-- Quality Score --}}
                             @include('dashboard.partials.metric-card', [
                            'label' => 'Quality Score',
                            'value' => $latestEntry->quality_score,
                            'max' => 2
                         ])

                           @foreach ($latestEntry->metricValues as $metricValue)
                           @include('dashboard.partials.metric-card', [
                            'label' => $metricValue->customMetric->name,
                            'value' => $metricValue->value,
                            'max' => $metricValue->customMetric->max_value ?? 10,
                            ])
                           @endforeach

                        </div>
                        @else
                            <p class="text-gray-400">No entries yet.</p>
                        @endif

                    </section>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
