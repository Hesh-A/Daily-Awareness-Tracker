<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-100">Profile</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-white">Account Settings</h1>
                <p class="text-sm text-gray-400 mt-1">Manage your profile and security</p>
            </div>
            <div class="space-y-6">

                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                    @include('profile.partials.delete-user-form')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
