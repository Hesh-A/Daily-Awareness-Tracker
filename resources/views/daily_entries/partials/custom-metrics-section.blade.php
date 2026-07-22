@if($customMetrics->count())
    <div class="border-t border-gray-700 pt-6 space-y-4">

        <h3 class="text-lg font-semibold text-white">Custom Metrics</h3>

        @foreach($customMetrics as $metric)
            @php
                   $value = $entry?->metricValues
                   ->where('custom_metric_id', $metric->id)
                   ->first()
                   ->value ?? '';

            @endphp

            <div>
                <x-input-label for="metric_{{ $metric->id }}" :value="$metric->name" />

                <x-text-input
                    id="metric_{{ $metric->id }}"
                    type="text"
                    name="customMetrics[{{ $metric->id }}]"
                    class="w-full bg-gray-700 border border-gray-600 rounded p-2"
                    value="{{ old('customMetrics.' . $metric->id, $value) }}"
                />

                <x-input-error :messages="$errors->get('customMetrics.' . $metric->id)" class="mt-1" />
            </div>
        @endforeach

    </div>
@endif
