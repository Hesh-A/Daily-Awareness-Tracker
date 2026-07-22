<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Daily Entries
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Success Alert --}}
            @include('daily_entries.partials.success-alert')

            {{-- Card --}}
            <div class="p-4 sm:p-8 bg-gray-800 border border-gray-700 shadow sm:rounded-lg">
                <div class="max-w-2xl mx-auto">

                    {{-- Header --}}
                    @include('daily_entries.partials.entries-header')

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

                </div>
            </div>

        </div>
    </div>

</x-app-layout>
