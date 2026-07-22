<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Edit Entry
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

         <div class="p-4 sm:p-8 bg-gray-800 border border-gray-700 shadow sm:rounded-lg">
          <div class="max-w-2xl mx-auto">
                <section>
                        <header>
                            <h2 class="text-lg font-medium text-white">Edit Entry Information</h2>
                            <p class="mt-1 text-sm text-gray-600">Edit your daily entry details.</p>
                        </header>

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
                </section>
           </div>
          </div>
        </div>
    </div>

</x-app-layout>