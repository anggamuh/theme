<x-app-layout head="Profile" title="Admin - Profile">
    <div class="sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 pb-20 sm:pb-8 px-4 space-y-4">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            @include('profile.partials.update-password-form')
        </div>

        {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div> --}}
    </div>
</x-app-layout>
