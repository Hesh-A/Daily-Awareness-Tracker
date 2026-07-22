<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Daily Entries
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-success-alert />

            <x-form-card>
                <x-index-header
                    title="Daily Entries"
                    description="Your Entry Overview"
                    add-label="Add New Entry"
                    :add-route="route('daily-entries.create')"
                />

                {{-- Entries List --}}
                <section class="space-y-4 mt-4">
                    @forelse ($entries as $entry)
                        @include('daily_entries.partials.entry-item', ['entry' => $entry])
                    @empty
                        <p class="text-gray-400 text-center py-6">
                            No entries yet. Create your first one!
                        </p>
                    @endforelse
                </section>
            </x-form-card>

        </div>
    </div>

</x-app-layout>
