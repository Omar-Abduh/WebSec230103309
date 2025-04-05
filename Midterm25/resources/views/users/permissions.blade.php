<x-app-layout>
    <x-slot name="title">
        {{ __('User: ' . $user->name . ' Permissions ') }}
    </x-slot>
    <x-slot name="header">
        <a href="{{ route('access-control-panel') }}">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Access Control Panel</h1>
        </a>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('User Access Control') }}
        </h2>
    </x-slot>
    <div class="max-w-6xl mx-auto mt-8 p-4">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-lg font-semibold dark:text-gray-200">{{ $user->name }}</h3>
                    <p class="text-gray-500 dark:text-gray-400">Direct Permissions</p>
                    <p class="text-gray-500 dark:text-gray-400">Total Permissions: {{ $user->getAllPermissions()->count() }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('user.index') }}">
                        <button
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            Back
                        </button>
                    </a>
                    <x-dropdown-modal :options="$permissions_total->map(
                        fn($perm) => [
                            'value' => $perm->name,
                            'text' => $perm->name,
                            'selected' => $user->getDirectPermissions()->contains($perm->name),
                        ],
                    )" :selected="$user->getDirectPermissions()->pluck('name')" name="direct_permissions[]"
                        placeholder="Search direct permissions..." triggerText="Assign Direct Permission" :user="$user"
                        :assignRoute="route('user.direct.permissions.assign', $user->id)" triggerClass="your-custom-class-if-needed" />
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="p-4">#</th>
                            <th class="p-4">Permissions</th>
                            <th class="p-4">Permissions Type</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @foreach ($permissions as $permission)
                            <tr class="border-t dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4">
                                   {{ $permission->id }}
                                </td>
                                <td class="p-4">{{ $permission->name }}</td>
                                <td class="p-4">
                                    <span class="inline-block {{ $user->hasDirectPermission($permission->name) ? 'bg-red-200 dark:bg-blue-700 text-gray-800 dark:text-blue-300' : 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-300' }}  text-sm px-2 py-1 rounded-lg mr-1">
                                        {{ $user->hasDirectPermission($permission->name) ? 'Direct Permission' : 'Role Permission' }}
                                    </span>
                                </td>
                                <td class="p-4 flex gap-2">
                                    <form method="POST"
                                        action="{{ route('user.permissions.remove', ['user' => $user->id, 'permission' => $permission->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="p-2 bg-yellow-200 dark:bg-yellow-700 rounded-lg hover:bg-yellow-300 dark:hover:bg-yellow-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd"
                                                    d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-4">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Page {{ $permissions->currentPage() }} of {{ $permissions->lastPage() }}
                </p>
                <div class="flex gap-2">
                    @if ($permissions->currentPage() > 1)
                        <a href="{{ $permissions->previousPageUrl() }}">
                            <button
                                class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                Previous
                            </button>
                        </a>
                    @endif
                    @if ($permissions->currentPage() < $permissions->lastPage())
                        <a href="{{ $permissions->nextPageUrl() }}">
                            <button
                                class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                Next
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <x-notification-alert />
</x-app-layout>
