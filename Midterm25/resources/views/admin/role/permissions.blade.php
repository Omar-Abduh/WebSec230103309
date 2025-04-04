<x-app-layout>
    <x-slot name="title">
        {{ __('Roles Management') }}
    </x-slot>
    <x-slot name="header">
        <a href="{{ route('access-control-panel') }}">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Access Control Panel</h1>
        </a>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Roles Management') }}
        </h2>
    </x-slot>
    <div class="max-w-6xl mx-auto mt-8 p-4">


        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-lg font-semibold dark:text-gray-200">Role: {{ $role->name }}</h3>
                    <p class="text-gray-500 dark:text-gray-400">Permissions that Assign to Admin Role - #
                        {{ count($role->permissions) }}</p>
                </div>
                <div class="flex gap-2">
                    <button
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">View
                        All</button>
                    <x-dropdown-modal :options="$permissions_total->map(
                        fn($perm) => [
                            'value' => $perm->name,
                            'text' => $perm->name,
                            'selected' => $role->permissions->contains($perm->name),
                        ],
                    )" :selected="$role->permissions->pluck('name')" name="permissions[]"
                        placeholder="Search permissions..." triggerText="Assign Permission" :role="$role"
                        :assignRoute="route('role.permissions.assign', $role->id)" triggerClass="your-custom-class-if-needed" />
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="p-4">#</th>
                            <th class="p-4">Permissions</th>
                            <th class="p-4">Updated At</th>
                            <th class="p-4">Created At</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @foreach ($permissions as $permission)
                            <!-- Use paginated permissions -->
                            <tr class="border-t dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4">
                                    {{ $loop->iteration + ($permissions->currentPage() - 1) * $permissions->perPage() }}
                                </td>
                                <td class="p-4">{{ $permission->name }}</td>
                                <td class="p-4">{{ $permission->updated_at->format('d M Y') }}</td>
                                <td class="p-4">{{ $permission->created_at->format('d M Y') }}</td>
                                <td class="p-4 flex gap-2">
                                    {{-- {{ route('permission.edit', $permission->id) }} --}}
                                    <form method="POST"
                                        action="{{ route('role.permissions.remove', ['role' => $role->id, 'permission' => $permission->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="p-2 bg-yellow-200 dark:bg-yellow-700 rounded-lg hover:bg-yellow-300 dark:hover:bg-yellow-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd"
                                                    d="M4.25 12a.75.75 0 0 1 .75-.75h14a.75.75 0 0 1 0 1.5H5a.75.75 0 0 1-.75-.75Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                        </button>
                                    </form>
                                    <a href="{{ route('permission.edit', $permission->id) }}">
                                        <button
                                            class="p-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path
                                                    d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.800a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                                                </path>
                                            </svg>
                                        </button>
                                    </a>
                                    <x-delete-modal item="Permission: {{ $permission->name }}"
                                        action="{{ route('permission.delete', $permission->id) }}" />
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
