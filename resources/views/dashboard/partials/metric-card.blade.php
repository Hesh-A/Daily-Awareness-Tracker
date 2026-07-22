@php
    $value = (float) $value;
    $max = (float) $max;
    $percentage = $max > 0 ? ($value / $max) * 100 : 0;

    if ($percentage < 33) {
        $barColor = 'bg-red-500';
    } elseif ($percentage < 66) {
        $barColor = 'bg-yellow-500';
    } else {
        $barColor = 'bg-green-500';
    }
@endphp


<div class="p-4 bg-gray-900 border border-gray-700 rounded-lg space-y-2">
    <div class="flex justify-between items-center">
        <h3 class="text-white font-semibold">{{ $label }}</h3>
        <span class="text-gray-300">{{ $value }} / {{ $max }}</span>
    </div>

    <div class="w-full bg-gray-700 rounded-full h-3">
        <div class="{{ $barColor }} h-3 rounded-full" style="width: {{ $percentage }}%"></div>
    </div>
</div>