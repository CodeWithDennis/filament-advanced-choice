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

    $componentProps = [
        'name', 'options', 'descriptions', 'extras', 'color',
        'columns', 'grid-direction',
        'hidden-inputs', 'hidden-input-icon', 'cursor-pointer',
        'searchable', 'search-prompt', 'no-search-results-message',
        'selected',
    ];

    $inputAttrs = $attributes->except($componentProps);
@endphp

<div
    x-data="{
        search: '',
        visibleOptionsCount: {{ count($options) }}
    }"
    class="fi-fo-checkbox-list"
>
    @if ($searchable)
        <div class="fi-fo-checkbox-list-search-input-wrp mb-4">
            <input
                placeholder="{{ __('filament-tables::table.fields.search.placeholder') }}"
                type="search"
                x-model="search"
                class="fi-input w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-sm shadow-sm"
            />
        </div>
    @endif

    <fieldset
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
        class="fi-fo-checkbox-list-options fi-fo-radio gap-4"
        style="{{ $gridStyle }}"
    >
        @foreach ($options as $value => $label)
            @php
                $id = $name . '-' . $value;
                $description = $descriptions[$value] ?? null;
                $extra = $extras[$value] ?? null;
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
                            name="{{ $name }}"
                            type="radio"
                            value="{{ $value }}"
                            @checked($selected === $value)
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
                            name="{{ $name }}"
                            type="radio"
                            value="{{ $value }}"
                            @checked($selected === $value)
                            {{ $inputAttrs }}
                            style="{{ $colors }}"
                            class="fi-radio-input mt-0.5 shrink-0 ml-3 checked:bg-custom-500 checked:border-custom-500 hover:checked:bg-custom-600 hover:checked:border-custom-600 focus:border-custom-500 focus:ring-custom-500"
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
