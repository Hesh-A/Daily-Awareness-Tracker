<div class="space-y-6">

    <div>
        <x-input-label for="entry_date" value="Date" />
        <x-text-input
            type="date"
            name="entry_date"
            id="entry_date"
            class="w-full bg-gray-700 border border-gray-600 rounded p-2"
            value="{{ old('entry_date', $entry->entry_date ?? '') }}"
        />
        <x-input-error :messages="$errors->get('entry_date')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="hours_creative_work" value="Hours of creative work" />
        <x-text-input
            type="number"
            name="hours_creative_work"
            id="hours_creative_work"
            class="w-full bg-gray-700 border border-gray-600 rounded p-2"
            value="{{ old('hours_creative_work', $entry->hours_creative_work ?? '') }}"
        />
        <x-input-error :messages="$errors->get('hours_creative_work')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="quality_score" value="Quality score (-2 to 2)" />
        <x-text-input
            type="number"
            name="quality_score"
            id="quality_score"
            class="w-full bg-gray-700 border border-gray-600 rounded p-2"
            value="{{ old('quality_score', $entry->quality_score ?? '') }}"
        />
        <x-input-error :messages="$errors->get('quality_score')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="notes" value="Notes (optional)" />
        <textarea
            id="notes"
            name="notes"
            rows="4"
            class="w-full bg-gray-700 border border-gray-600 rounded p-2 text-gray-100"
        >{{ old('notes', $entry->notes ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('notes')" class="mt-1" />
    </div>

</div>
