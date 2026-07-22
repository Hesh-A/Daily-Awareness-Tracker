<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Edit Entry
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-form-card>
                <x-form-section title="Edit Entry Information" description="Edit your daily entry details.">
                    <form method="POST" action="{{ route('daily-entries.update', $entry) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        @include('daily_entries.partials.entry-fields', [
                            'entry' => $entry,
                            'customMetrics' => $customMetrics
                        ])

                        @include('daily_entries.partials.custom-metrics-section', [
                            'entry' => $entry,
                            'customMetrics' => $customMetrics
                        ])

                        <x-primary-button>Update Entry</x-primary-button>
                    </form>
                </x-form-section>
            </x-form-card>

        </div>
    </div>

</x-app-layout>