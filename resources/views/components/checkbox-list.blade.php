@php
    use function Filament\Support\get_color_css_variables;

    $resolvedColor = $resolvedColor();

    $colors = $resolvedColor
        ? \Illuminate\Support\Arr::toCssStyles([
            get_color_css_variables($resolvedColor, shades: [50, 100, 200, 400, 500, 600, 700, 800]),
        ])
        : '';

    $selectedArray = (array) $selected;

    $componentProps = [
        'name', 'options', 'descriptions', 'extras', 'color',
        'hidden-inputs', 'hidden-input-icon', 'cursor-pointer',
        'bulk-toggleable',
        'searchable', 'search-prompt', 'no-search-results-message',
        'selected',
    ];

    $inputAttrs = $attributes->except($componentProps);

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
@endphp

<div
    x-data="{
        search: '',
        allChecked: false,
        visibleOptionsCount: {{ count($options) }},
        wireModel: @js($wireModel),
        allValues: @js(array_keys($options)),

        toggleAll() {
            this.allChecked = !this.allChecked;

            if (this.wireModel && typeof $wire !== 'undefined') {
                if (this.allChecked) {
                    $wire.set(this.wireModel, this.allValues);
                } else {
                    $wire.set(this.wireModel, []);
                }
            } else {
                $el.querySelectorAll('input[type=checkbox][data-bulk-toggle]')
                    .forEach(cb => { cb.checked = this.allChecked; });
            }

            $nextTick(() => {
                const all = $el.querySelectorAll('input[type=checkbox][data-bulk-toggle]');
                this.allChecked = all.length > 0 && [...all].every(cb => cb.checked);
            });
        },

        checkIfAllChecked() {
            const all = $el.querySelectorAll('input[type=checkbox][data-bulk-toggle]');
            this.allChecked = all.length > 0 && [...all].every(cb => cb.checked);
        }
    }"
    class="fi-fo-checkbox-list"
>
    @if ($bulkToggleable && count($options))
        <div
            x-cloak
            class="fi-fo-checkbox-list-actions mb-2"
            style="{{ $colors }}"
        >
            <button
                type="button"
                x-show="!allChecked"
                x-on:click="toggleAll()"
                class="text-sm text-custom-600 dark:text-custom-400 hover:underline focus:outline-none"
            >
                {{ __('filament-forms::components.checkbox_list.actions.select_all.label') }}
            </button>
            <button
                type="button"
                x-show="allChecked"
                x-on:click="toggleAll()"
                class="text-sm text-custom-600 dark:text-custom-400 hover:underline focus:outline-none"
            >
                {{ __('filament-forms::components.checkbox_list.actions.deselect_all.label') }}
            </button>
        </div>
    @endif

    @if ($searchable)
        <x-filament::input.wrapper
            inline-prefix
            :prefix-icon="\Filament\Support\Icons\Heroicon::MagnifyingGlass"
            prefix-icon-alias="forms:components.checkbox-list.search-field"
            class="fi-fo-checkbox-list-search-input-wrp"
        >
            <x-filament::input
                type="search"
                :placeholder="__('filament-tables::table.fields.search.placeholder')"
                x-model="search"
                class="fi-input-has-inline-prefix"
            />
        </x-filament::input.wrapper>
    @endif

    <fieldset
        x-ref="fieldset"
        @if ($searchable)
            x-show="visibleOptionsCount > 0"
            x-effect="
                let count = 0;
                $refs.fieldset.querySelectorAll('label[data-checkbox-option]').forEach(label => {
                    const labelText = label.querySelector('.option-label')?.innerText?.toLowerCase() ?? '';
                    const descText  = label.querySelector('.option-description')?.innerText?.toLowerCase() ?? '';
                    const match = !search
                        || labelText.includes(search.toLowerCase())
                        || descText.includes(search.toLowerCase());
                    label.style.display = match ? '' : 'none';
                    if (match) count++;
                });
                visibleOptionsCount = count;
            "
        @endif
        class="fi-fo-checkbox-list-options -space-y-px rounded-md bg-white dark:bg-gray-900"
    >
        @foreach ($options as $value => $label)
            @php
                $id = $name . '-' . $value;
                $description = $descriptions[$value] ?? null;
                $extra = $extras[$value] ?? null;
                $isChecked = in_array($value, $selectedArray, true);
            @endphp

            <label
                for="{{ $id }}"
                data-checkbox-option
                @class([
                    'fi-fo-checkbox-list-option group flex border border-gray-200 dark:border-gray-700 p-4 first:rounded-tl-md first:rounded-tr-md last:rounded-br-md last:rounded-bl-md focus:outline-hidden has-checked:relative has-checked:border-custom-200 dark:has-checked:border-custom-500 has-checked:bg-custom-50 dark:has-checked:bg-custom-800/10 has-disabled:opacity-60 has-disabled:cursor-not-allowed',
                    'not-has-disabled:cursor-pointer' => $cursorPointer,
                ])
                style="{{ $colors }}"
            >
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center gap-3">
                                @if (!$hiddenInputs)
                            <input
                                id="{{ $id }}"
                                name="{{ $name }}[]"
                                type="checkbox"
                                value="{{ $value }}"
                                @checked($isChecked)
                                data-bulk-toggle
                                @if ($bulkToggleable)
                                    x-on:change="checkIfAllChecked()"
                                @endif
                                {{ $inputAttrs }}
                                style="{{ $colors }}"
                                class="fi-checkbox-input shrink-0 checked:bg-custom-500 checked:border-custom-500 hover:checked:bg-custom-600 hover:checked:border-custom-600 focus:border-custom-500 focus:ring-custom-500"
                            />
                        @endif
                        <span class="flex flex-col">
                            <span class="option-label block text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $label }}
                            </span>
                            @if ($description)
                                <span class="option-description block text-sm text-gray-500 dark:text-gray-400">
                                    {{ $description }}
                                </span>
                            @endif
                        </span>
                    </div>
                    @if ($extra)
                        <span class="text-sm text-gray-800 dark:text-gray-100">
                            {{ $extra }}
                        </span>
                    @endif
                </div>
                @if ($hiddenInputs)
                    <input
                        id="{{ $id }}"
                        name="{{ $name }}[]"
                        type="checkbox"
                        value="{{ $value }}"
                        @checked($isChecked)
                        data-bulk-toggle
                        @if ($bulkToggleable)
                            x-on:change="checkIfAllChecked()"
                        @endif
                        {{ $inputAttrs }}
                        class="absolute inset-0 appearance-none focus:outline-none"
                    />
                @endif
            </label>
        @endforeach
    </fieldset>

    @if ($searchable)
        <div
            x-cloak
            x-show="search && !visibleOptionsCount"
            class="fi-fo-checkbox-list-no-search-results-message px-3 py-2 text-sm text-gray-500"
        >
            {{ $getNoSearchResultsMessage() }}
        </div>
    @endif
</div>
