<div class="border-b border-gray-600 pb-4"> 

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 p-4 bg-gray-900 border border-gray-700 rounded-lg">
        {{-- Name --}}
        <h3 class="text-md text-white">
            {{ $metric->name }}
        </h3>

        {{--Actions--}}

        <div class="flex flex-wrap gap-4 text-sm">
            <form action="{{ route('custom-metrics.destroy', $metric) }}"
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


    </div >
</div>