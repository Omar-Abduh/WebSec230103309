@props([
    'title' => 'Delete Item',
    'message' => 'Are you sure you want to delete this item? This action cannot be undone.',
    'item' => '',
    'action' => '',
])

<div x-data="{ showModal: false }" class="inline-block">
    <!-- Delete Button -->
    <button @click="showModal = true"
        class="p-2 bg-red-200 dark:bg-red-700 rounded-lg hover:bg-red-300 dark:hover:bg-red-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
            <path d="M6 19a2 2 0 002 2h8a2 2 0 002-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"></path>
        </svg>
    </button>

    <!-- Blur Background Overlay -->
    <div x-show="showModal" class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
        <div class="absolute inset-0 bg-black bg-opacity-30 backdrop-blur-sm"></div>
    </div>

    <!-- Modal -->
    <div x-show="showModal"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="fixed z-10 inset-0 overflow-y-auto flex items-center justify-center"
         x-cloak>
        <div class="bg-white rounded-lg shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg font-medium text-gray-900">{{ $title }}</h3>
                        <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete {{ $item }}? This action cannot be undone.</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 flex flex-row-reverse gap-3">
                <form method="POST" action="{{ $action }}" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-red-500 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Delete
                    </button>
                </form>
                <button @click="showModal = false" type="button" class="flex-1 inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>