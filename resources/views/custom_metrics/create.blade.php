<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Create Custom Metric
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-gray-800 border border-gray-700 shadow sm:rounded-lg">
                <div class="max-w-2xl mx-auto">

                    <section class="space-y-4">
                        <header>
                            <h2 class="text-lg font-medium text-white">Matric Information</h2>
                            <p class="mt-1 text-sm text-gray-600">Fill in your daily entry details.</p>
                        </header>
                        <form method="POST" action= "{{route('custom-metrics.store')}}" class= "space-y-6">
                        @csrf

                         @include ('custom_metrics.partials.metric-fields')

                           <x-primary-button class="px-6 py-3 text-base">Save Matric</x-primary-button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    


</x-app-layout>