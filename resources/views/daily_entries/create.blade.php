<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Create Daily Entry
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-form-card>
                <x-form-section title="Daily Information" description="Fill in your daily entry details.">
                    <form method="POST" action="{{ route('daily-entries.store') }}" class="mt-6 space-y-6">
                        @csrf

                        @include('daily_entries.partials.entry-fields', [
                            'entry' => null,
                            'customMetrics' => $customMetrics
                        ])

                        @include('daily_entries.partials.custom-metrics-section', [
                            'entry' => null,
                            'customMetrics' => $customMetrics
                        ])

                        <x-primary-button class="px-6 py-3 text-base">Save Entry</x-primary-button>
                    </form>
                </x-form-section>
            </x-form-card>

        </div>
    </div>

</x-app-layout>
