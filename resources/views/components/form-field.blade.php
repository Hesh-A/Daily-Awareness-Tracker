@props(['name', 'label', 'inputId' => null])

<div>
    <x-input-label :for="$inputId ?? $name" :value="$label" class="block mb-1" />
    {{ $slot }}
    <x-input-error :messages="$errors->get($name)" class="mt-1" />
</div>
