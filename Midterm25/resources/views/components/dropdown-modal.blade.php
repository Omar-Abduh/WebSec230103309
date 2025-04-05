@props([
    'options' => [],
    'selected' => [],
    'placeholder' => 'Search permissions...',
    'name' => 'permissions[]',
    'triggerClass' => '',
    'triggerText' => null,
    'modalWidth' => 'sm:max-w-lg',
    'role' => null, // Add role prop
    'user' => null, // Add user prop for direct permissions
    'assignRoute' => null, // Allow route prop to be null for flexibility
    'directPermissions' => [] // Add directPermissions prop
])

<div x-data="dropdownModal(@js($options), @js($directPermissions))" x-init="init()">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Trigger Button - Modified to match your design -->
    <button @click="openModal" 
            class="{{ $triggerClass }} px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-lg flex items-center gap-2 hover:bg-gray-900 dark:hover:bg-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
            <path fill-rule="evenodd"
                d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                clip-rule="evenodd" />
        </svg>
        {{ $triggerText }}
    </button>

    <!-- Blur Background Overlay -->
    <div x-show="isOpen" x-cloak class="fixed inset-0 transition-opacity z-40" aria-hidden="true"
        @click="closeModal">
        <div class="absolute inset-0 bg-black bg-opacity-30 backdrop-blur-sm dark:bg-opacity-60"></div>
    </div>

    <!-- Modal -->
    <div x-show="isOpen" x-cloak 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="fixed z-50 inset-0 overflow-y-auto flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl transform transition-all {{ $modalWidth }} w-full">
            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mt-3 text-center sm:mt-0 sm:text-left">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ $triggerText }} to {{ $role ? $role->name : ($user ? $user->name : 'Entity') }}
                    </h3>
                    
                    <!-- Search Input -->
                    <div class="mt-4">
                        <input x-ref="searchInput"
                               x-model="search"
                               @input="onSearch"
                               placeholder="{{ $placeholder }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    
                    <!-- Selected Items -->
                    <div class="mt-4 flex flex-wrap gap-2">
                        <template x-for="(optionIndex, selectedIndex) in selected" :key="optionIndex">
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                <span x-text="options[optionIndex].text"></span>
                                <button @click.stop="remove(selectedIndex, optionIndex)" class="ml-1.5 inline-flex text-indigo-600 dark:text-indigo-300 focus:outline-none">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>
                    
                    <!-- Options List -->
                    <div class="mt-4 max-h-60 overflow-y-auto border border-gray-200 dark:border-gray-700 rounded-md">
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            <template x-for="(option, index) in filteredOptions" :key="index">
                                <li class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer"
                                    :class="{ 
                                        'bg-gray-100 dark:bg-gray-600': focusedOptionIndex === index,
                                        'bg-indigo-50 dark:bg-indigo-900': option.selected
                                    }"
                                    @click="select(index, $event)"
                                    @mouseenter="focusedOptionIndex = index">
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600"
                                               :checked="option.selected">
                                        <span class="ml-3 block text-gray-700 dark:text-gray-200" x-text="option.text"></span>
                                    </div>
                                </li>
                            </template>
                            <li x-show="filteredOptions.length === 0" class="px-4 py-3 text-gray-500 dark:text-gray-400">
                                No permissions found
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Modal Footer with form submission -->
            <form method="POST" action="{{ $assignRoute ?? '#' }}" class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 flex justify-end gap-3">
                @csrf
                <input type="hidden" name="permissions" x-bind:value="selectedValues()">
                
                <button @click="closeModal" type="button"
                    class="inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 px-4 py-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800">
                    Cancel
                </button>
                <button type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Assign Selected
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function dropdownModal(initialOptions = [], initialDirectPermissions = []) {
    return {
        options: [],
        selected: [],
        isOpen: false,
        search: '',
        focusedOptionIndex: -1,
        filteredOptions: [],
        init() {
            this.options = initialOptions.map((option, index) => ({
                value: option.value || option.id || option.name,
                text: option.text || option.name,
                selected: option.selected || false
            }));

            this.selected = this.options
                .map((option, index) => option.selected ? index : null)
                .filter(index => index !== null);

            this.filteredOptions = this.options;

            // Handle directPermissions
            initialDirectPermissions.forEach(permission => {
                const index = this.options.findIndex(option => option.value === permission);
                if (index !== -1) {
                    this.options[index].selected = true;
                    this.selected.push(index);
                }
            });
        },
        onSearch: debounce(function(e) {
            const searchTerm = e.target.value.toLowerCase();
            this.filteredOptions = this.options.filter(option => 
                option.text.toLowerCase().includes(searchTerm)
            );
            this.focusedOptionIndex = this.filteredOptions.length > 0 ? 0 : -1;
        }, 300),
        openModal() {
            this.isOpen = true;
            this.$nextTick(() => {
                this.$refs.searchInput.focus();
            });
        },
        closeModal() {
            this.isOpen = false;
        },
        select(index, event) {
            event.stopPropagation();
            const option = this.filteredOptions[index];
            const originalIndex = this.options.findIndex(o => o.value === option.value);
            
            if (!option.selected) {
                option.selected = true;
                this.options[originalIndex].selected = true;
                this.selected.push(originalIndex);
            } else {
                option.selected = false;
                this.options[originalIndex].selected = false;
                const selectedIndex = this.selected.indexOf(originalIndex);
                if (selectedIndex > -1) {
                    this.selected.splice(selectedIndex, 1);
                }
            }
        },
        remove(selectedIndex, optionIndex) {
            this.options[optionIndex].selected = false;
            this.selected.splice(selectedIndex, 1);
            
            // Update filtered options if visible
            const filteredIndex = this.filteredOptions.findIndex(o => o.value === this.options[optionIndex].value);
            if (filteredIndex > -1) {
                this.filteredOptions[filteredIndex].selected = false;
            }
        },
        selectedValues() {
            return this.selected.map((index) => {
                return this.options[index].value;
            }).join(',');
        }
    }
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func.apply(this, args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
</script>