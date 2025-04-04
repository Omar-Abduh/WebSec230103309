<x-app-layout>
    <x-slot name="title">
        {{ __('Access Control Panel') }}
    </x-slot>
    <x-slot name="header">
        <a href="{{ route('access-control-panel') }}">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Access Control Panel</h1>
        </a>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            <span class="text-lg">
                <a href="{{ route('user.index') }}" class="ml-4">User Access Control</a>
                <a href="{{ route('role.index') }}" class="ml-4">Roles Management</a>
                <a href="{{ route('permission.index') }}" class="ml-4">Permissions Management</a>
            </span>
        </h2>
    </x-slot>
    <div class="max-w-6xl mx-auto mt-8 p-4">


        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
            <div class="flex justify-center items-center mb-4">
                <div>
                    <h3 class="text-lg font-semibold dark:text-gray-200">Access Control Panel Dashboard</h3>
                    <p class="text-gray-500 dark:text-gray-400">Welcome to Access Control Panel {{ Auth::user()->name }} 👋
                    </p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="p-4">Name</th>
                            <th class="p-4">Total</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        <tr class="border-t dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
    
                            <td class="p-4">User Access Control</td>
                            <td class="p-4">{{ $users }}</td>
                            <td class="p-4">
                                <a href="{{ route('user.index') }}">
                                    <button
                                        class="p-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                        </svg>
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <tr class="border-t dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">

                            <td class="p-4">Roles Management</td>
                            <td class="p-4">{{ $roles }}</td>
                            <td class="p-4">
                                <a href="{{ route('role.index') }}">
                                    <button
                                        class="p-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                        </svg>
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <tr class="border-t dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">

                            <td class="p-4">Permissions Management</td>
                            <td class="p-4">{{ $permissions }}</td>
                            <td class="p-4">
                                <a href="{{ route('permission.index') }}">
                                    <button
                                        class="p-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                        </svg>
                                    </button>
                                </a>
                            </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <x-notification-alert />

</x-app-layout>
