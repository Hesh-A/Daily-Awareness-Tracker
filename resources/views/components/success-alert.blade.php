@if (session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        class="mb-6 bg-green-900/30 border border-green-700 text-green-300 p-4 rounded"
    >
        {{ session('success') }}
    </div>
@endif
