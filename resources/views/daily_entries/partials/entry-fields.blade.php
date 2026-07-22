<div class="space-y-6">

    <x-form-field name="entry_date" label="Date">
        <x-text-input
            type="date"
            name="entry_date"
            id="entry_date"
            class="w-full bg-gray-700 border border-gray-600 rounded p-2"
            value="{{ old('entry_date', $entry->entry_date ?? '') }}"
        />
    </x-form-field>

    <x-form-field name="hours_creative_work" label="Hours of creative work">
        <x-text-input
            type="number"
            name="hours_creative_work"
            id="hours_creative_work"
            class="w-full bg-gray-700 border border-gray-600 rounded p-2"
            value="{{ old('hours_creative_work', $entry->hours_creative_work ?? '') }}"
        />
    </x-form-field>

    <x-form-field name="quality_score" label="Quality score (-2 to 2)">
        <x-text-input
            type="number"
            name="quality_score"
            id="quality_score"
            class="w-full bg-gray-700 border border-gray-600 rounded p-2"
            value="{{ old('quality_score', $entry->quality_score ?? '') }}"
        />
    </x-form-field>

    <x-form-field name="notes" label="Notes (optional)">
        <x-textarea name="notes" id="notes" rows="4">{{ old('notes', $entry->notes ?? '') }}</x-textarea>
    </x-form-field>

</div>
