<x-app-layout>
    <x-slot name="title">
        {{ __('Create Roles') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>
    <div class="max-w-5xl mx-auto mt-8 p-4">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-lg font-semibold dark:text-gray-200">Add Role</h3>
                </div>

            </div>
            <div class="overflow-x-auto">
                <form action="{{ route('role.store') }}" method="POST" class="mt-6 space-y-6">
                    @csrf
                    @method('POST')
                    <div>
                        <x-input-label for="name" :value="__('Role Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', )" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-4">
                        <button type="submit"
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
