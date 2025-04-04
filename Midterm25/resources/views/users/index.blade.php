<x-app-layout>
    <x-slot name="title">
        {{ __('User Access Control') }}
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
                    <h3 class="text-lg font-semibold dark:text-gray-200">Users List</h3>
                    <p class="text-gray-500 dark:text-gray-400">Total Users {{ count($users_total) }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('user.show') }}">
                        <button
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">View
                            All
                        </button>
                    </a>
                    <a href="{{ route('user.create') }}">
                        <button
                            class="px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-lg flex items-center gap-2 hover:bg-gray-900 dark:hover:bg-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.630l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                </path>
                            </svg>
                            Add user
                        </button>
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="p-4">#</th>
                            <th class="p-4">Name</th>
                            <th class="p-4">Email</th>
                            <th class="p-4">Role</th>
                            <th class="p-4">Updated At</th>
                            <th class="p-4">Created At</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @foreach ($users as $user)
                            <tr class="border-t dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">

                                <td class="p-4">{{ $user->id }}</td>
                                <td class="p-4">{{ $user->name }}</td>
                                <td class="p-4">{{ $user->email }}</td>
                                <td class="p-4">
                                    @if ($user->hasRole('Admin'))
                                        <span
                                            class=" bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold">Admin</span>
                                    @elseif ($user->hasRole('Employee'))
                                        <span
                                            class="bg-green-500  text-white px-2 py-1 rounded-full text-xs font-semibold">Employee</span>
                                    @elseif ($user->hasRole('Customer'))
                                        <span
                                            class=" bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-semibold">Customer</span>
                                    @else
                                        <span
                                            class="bg-gray-500 text-white px-2 py-1 rounded-full text-xs font-semibold">No
                                            Role</span>
                                    @endif
                                </td>
                                <td class="p-4">{{ $user->updated_at->format('d M Y') }}</td>
                                <td class="p-4">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="p-4 flex gap-2">
                                    <a href="{{ route('user.edit', $user->id) }}">
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
                                    <x-delete-modal item="user: {{ $user->name }}"
                                        action="{{ route('user.delete', $user->id) }}" />

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-4">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                </p>
                <div class="flex gap-2">
                    @if ($users->currentPage() > 1)
                        <a href="{{ $users->previousPageUrl() }}">
                            <button
                                class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                Previous
                            </button>
                        </a>
                    @endif
                    @if ($users->currentPage() < $users->lastPage())
                        <a href="{{ $users->nextPageUrl() }}">
                            <button
                                class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                Next
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <x-notification-alert />

</x-app-layout>
