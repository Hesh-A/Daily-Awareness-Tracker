<div class="space-y-6">

    <x-form-field name="name" label="Metric Name">
        <x-text-input
            type="text"
            name="name"
            id="name"
            :value="old('name')"
            class="w-full bg-gray-700 border border-gray-600 rounded p-2"
        />
    </x-form-field>

    <x-form-field name="description" label="Metric Description (optional)">
        <x-textarea name="description" id="description" rows="4">{{ old('description') }}</x-textarea>
    </x-form-field>

</div>