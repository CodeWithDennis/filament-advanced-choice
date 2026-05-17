@php
    use function Filament\Support\get_color_css_variables;

    $resolvedColor = $resolvedColor();

    $colors = $resolvedColor
        ? \Illuminate\Support\Arr::toCssStyles([
            get_color_css_variables($resolvedColor, shades: [50, 100, 400, 500, 600, 700, 800]),
        ])
        : '';

    $gridStyle = sprintf(
        'display: grid; grid-template-columns: repeat(%d, minmax(0, 1fr)); gap: 1rem;',
        max(1, $columns)
    );

    $selectedArray = (array) $selected;

    $componentProps = [
        'name', 'options', 'descriptions', 'extras', 'color',
        'columns', 'grid-direction',
        'hidden-inputs', 'hidden-input-icon', 'cursor-pointer',
        'bulk-toggleable',
        'searchable', 'search-prompt', 'no-search-results-message',
        'selected',
    ];

    $inputAttrs = $attributes->except($componentProps);
@endphp

<div
    x-data="{
        search: '',
        allChecked: false,
        visibleOptionsCount: {{ count($options) }},
        toggleAll() {
            this.allChecked = !this.allChecked;
            const checkboxes = $el.querySelectorAll('input[type=checkbox][data-bulk-toggle]');
            checkboxes.forEach(cb => {
                cb.checked = this.allChecked;
                cb.dispatchEvent(new Event('change', { bubbles: true }));
                cb.dispatchEvent(new Event('input',  { bubbles: true }));
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

    <div
        x-ref="fieldset"
        @if ($searchable)
            x-show="visibleOptionsCount > 0"
            x-effect="
                let count = 0;
                $refs.fieldset.querySelectorAll('.fi-fo-checkbox-list-option-ctn').forEach(el => {
                    const labelText = el.querySelector('.option-label')?.innerText?.toLowerCase() ?? '';
                    const descText  = el.querySelector('.option-description')?.innerText?.toLowerCase() ?? '';
                    const match = !search
                        || labelText.includes(search.toLowerCase())
                        || descText.includes(search.toLowerCase());
                    el.style.display = match ? '' : 'none';
                    if (match) count++;
                });
                visibleOptionsCount = count;
            "
        @endif
        class="fi-fo-checkbox-list-options gap-4"
        style="{{ $gridStyle }}"
    >
        @forelse ($options as $value => $label)
            @php
                $id = $name . '-' . $value;
                $description = $descriptions[$value] ?? null;
                $extra = $extras[$value] ?? null;
                $isChecked = in_array($value, $selectedArray, true);
            @endphp

            <div class="fi-fo-checkbox-list-option-ctn">
                <label
                    for="{{ $id }}"
                    @class([
                        'fi-fo-checkbox-list-option group relative flex rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 p-4 has-checked:outline-2 has-checked:-outline-offset-1 has-checked:outline-custom-600 dark:has-checked:outline-custom-500 has-focus-visible:outline-3 has-focus-visible:-outline-offset-1 has-disabled:opacity-60 has-disabled:cursor-not-allowed',
                        'not-has-disabled:cursor-pointer' => $cursorPointer,
                    ])
                    style="{{ $colors }}"
                >
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

                    <div class="flex-1">
                        <span class="option-label block text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $label }}
                        </span>
                        @if ($description)
                            <span class="option-description mt-1 block text-sm text-gray-500 dark:text-gray-400">{{ $description }}</span>
                        @endif
                        @if ($extra)
                            <span class="mt-6 block text-sm font-medium text-gray-900 dark:text-gray-100">{{ $extra }}</span>
                        @endif
                    </div>

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
                            class="fi-checkbox-input mt-0.5 shrink-0 ml-3 checked:bg-custom-500 checked:border-custom-500 hover:checked:bg-custom-600 hover:checked:border-custom-600 focus:border-custom-500 focus:ring-custom-500"
                        />
                    @endif

                    @if ($hiddenInputs)
                        <x-filament::icon
                            :icon="$hiddenInputIcon"
                            class="invisible size-5 text-custom-600 dark:text-custom-500 group-has-checked:visible absolute top-2 right-2"
                        />
                    @endif
                </label>
            </div>
        @empty
            <div></div>
        @endforelse
    </div>

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
