<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Create Custom Metric
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-form-card>
                <x-form-section title="Metric Information" description="Define a new custom metric to track.">
                    <form method="POST" action="{{ route('custom-metrics.store') }}" class="space-y-6">
                        @csrf

                        @include('custom_metrics.partials.metric-fields')

                        <x-primary-button class="px-6 py-3 text-base">Save Metric</x-primary-button>
                    </form>
                </x-form-section>
            </x-form-card>

        </div>
    </div>
    


</x-app-layout>