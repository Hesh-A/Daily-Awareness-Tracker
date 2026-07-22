<div class="border-b border-gray-600 pb-4">

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 p-4 bg-gray-900 border border-gray-700 rounded-lg">

        {{-- Date --}}
        <h3 class="text-md text-white">
            {{ \Carbon\Carbon::parse($entry->entry_date)->format('F j, Y') }}
        </h3>

        {{-- Actions --}}
        <div class="flex flex-wrap gap-4 text-sm">

            <a href="{{ route('daily-entries.edit', $entry) }}"
               class="text-yellow-400 hover:underline">
                Edit
            </a>

            <a href="{{ route('daily-entries.show', $entry) }}"
               class="text-blue-400 hover:underline">
                View
            </a>

            <form action="{{ route('daily-entries.destroy', $entry) }}"
                  method="POST"
                  class="inline">
                @csrf
                @method('DELETE')
                <button class="text-red-400 hover:underline"
                        onclick="return confirm('Delete this entry?')">
                    Delete
                </button>
            </form>

        </div>

    </div>

</div>
