<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Account Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="bg-white dark:bg-gray-800 p-8 shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-indigo-500"></div>

                <div class="max-w-xl [&_header]:hidden">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Profile Information</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Update your account's profile information, email address, and student credentials.</p>

                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-8 shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>

                <div class="max-w-xl [&_header]:hidden">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Update Password</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Ensure your account is using a long, random password to stay secure.</p>

                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-8 shadow-lg sm:rounded-2xl border border-red-100 dark:border-red-900/50 relative overflow-hidden mt-12">
                <div class="absolute top-0 left-0 w-2 h-full bg-red-500"></div>

                <div class="max-w-xl [&_header]:hidden">
                    <h3 class="text-xl font-bold text-red-600 dark:text-red-400 mb-1">Danger Zone</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Once your account is deleted, all of your resources and event registrations will be permanently wiped.</p>

                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>