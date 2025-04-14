@props([
    'options' => [],
    'selected' => [],
    'placeholder' => 'Select an option',
    'name' => 'values',
    'class' => 'md:w-1/2',
])

<div>
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    <div x-data="dropdown(@js($options))" x-init="init()" @keydown.escape.stop="close"
        @keydown.arrow-down.prevent="focusNextOption()" @keydown.arrow-up.prevent="focusPreviousOption()"
        @keydown.enter.prevent="selectFocused()" class="w-full {{ $class }}">
        <input type="hidden" name="{{ $name }}" x-bind:value="selectedValues()">
        <div class="relative w-full">
            <div class="flex flex-col relative">
                <div x-on:click="open" class="w-full">
                    <div
                        class="my-2 p-1 flex border border-gray-100 bg-white rounded dark:border-gray-700 dark:bg-gray-800">
                        <div class="flex flex-auto flex-wrap">
                            <template x-for="(optionIndex, selectedIndex) in selected" :key="optionIndex">
                                <div
                                    class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-full text-teal-700 bg-teal-100 border border-teal-300 dark:bg-teal-900 dark:text-teal-200 dark:border-teal-700">
                                    <div class="text-xs font-normal leading-none max-w-full flex-initial"
                                        x-text="options[optionIndex].text"></div>
                                    <div class="flex flex-auto flex-row-reverse">
                                        <div x-on:click.stop="remove(selectedIndex, optionIndex)">
                                            <svg class="fill-current h-6 w-6" role="button" viewBox="0 0 20 20">
                                                <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                     c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                     l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                     C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="selected.length == 0" class="flex-1">
                                <input x-ref="searchInput" x-model="search" @input="onSearch" @click.stop="open"
                                    placeholder="{{ $placeholder }}"
                                    class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800 dark:text-gray-200">
                            </div>
                        </div>
                        <div
                            class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 dark:border-gray-700">
                            <button type="button" x-show="isOpen() === true" x-on:click="open"
                                class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
L17.418,6.109z" />
                                </svg>
                            </button>
                            <button type="button" x-show="isOpen() === false" @click="close"
                                class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="w-full px-4">
                    <div x-show.transition.origin.top="isOpen()"
                        class="absolute shadow top-100 bg-white z-40 w-full lef-0 rounded max-h-select overflow-y-auto dark:bg-gray-800 dark:shadow-gray-700"
                        x-on:click.away="close">
                        <div class="flex flex-col w-full">
                            <template x-for="(option, index) in filteredOptions" :key="index">
                                <div>
                                    <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100 dark:border-gray-700 dark:hover:bg-teal-900"
                                        @click="select(index, $event)"
                                        :class="{ 'bg-teal-50 dark:bg-teal-900': focusedOptionIndex === index }">
                                        <div x-bind:class="option.selected ? 'border-teal-600 dark:border-teal-400' : ''"
                                            class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                            <div class="w-full items-center flex">
                                                <div class="mx-2 leading-6 dark:text-gray-200" x-text="option.text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function dropdown(initialOptions = []) {
            return {
                options: [],
                selected: [],
                show: false,
                search: '',
                focusedOptionIndex: -1,
                filteredOptions: [],
                init() {
                    this.options = initialOptions.map((option, index) => ({
                        value: option.value || option.id,
                        text: option.text || option.name,
                        selected: option.selected || false
                    }));

                    this.selected = this.options
                        .map((option, index) => option.selected ? index : null)
                        .filter(index => index !== null);

                    this.filteredOptions = this.options;
                },
                onSearch: debounce(function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    this.filteredOptions = this.options.filter(option =>
                        option.text.toLowerCase().includes(searchTerm)
                    );
                }, 300),
                focusNextOption() {
                    if (this.focusedOptionIndex < this.filteredOptions.length - 1) {
                        this.focusedOptionIndex++;
                    }
                },
                focusPreviousOption() {
                    if (this.focusedOptionIndex > 0) {
                        this.focusedOptionIndex--;
                    }
                },
                selectFocused() {
                    if (this.focusedOptionIndex >= 0) {
                        this.select(this.focusedOptionIndex);
                    }
                },
                open() {
                    this.show = true;
                    this.$nextTick(() => {
                        this.$refs.searchInput.focus();
                    });
                },
                close() {
                    this.show = false;
                },
                isOpen() {
                    return this.show === true;
                },
                select(index, event) {
                    event.stopPropagation();
                    if (!this.options[index].selected) {
                        this.options[index].selected = true;
                        this.selected.push(index);
                    } else {
                        const selectedIndex = this.selected.indexOf(index);
                        if (selectedIndex > -1) {
                            this.selected.splice(selectedIndex, 1);
                        }
                        this.options[index].selected = false;
                    }
                },
                remove(selectedIndex, index) {
                    this.options[index].selected = false;
                    this.selected.splice(selectedIndex, 1);
                },
                selectedValues() {
                    return this.selected.map((index) => {
                        return this.options[index].value;
                    });
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
</div>
