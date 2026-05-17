@php
    use function Filament\Support\get_color_css_variables;

    $resolvedColor = $resolvedColor();

    $colors = $resolvedColor
        ? \Illuminate\Support\Arr::toCssStyles([
            get_color_css_variables($resolvedColor, shades: [50, 100, 200, 400, 500, 600, 700, 800]),
        ])
        : '';

    $componentProps = [
        'name', 'options', 'descriptions', 'extras', 'color',
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
        <div class="fi-fo-checkbox-list-search-input-wrp mb-3">
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
                $refs.fieldset.querySelectorAll('label').forEach(label => {
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
            @endphp

            <label
                for="{{ $id }}"
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
                                name="{{ $name }}"
                                type="radio"
                                value="{{ $value }}"
                                @checked($selected === $value)
                                {{ $inputAttrs }}
                                class="relative size-4 shrink-0 appearance-none rounded-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 before:absolute before:inset-1 before:rounded-full before:bg-white dark:before:bg-gray-800 not-checked:before:hidden checked:border-custom-600 checked:bg-custom-600 focus-visible:outline-1 focus-visible:outline-offset-1 focus-visible:outline-custom-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 dark:disabled:border-gray-700 dark:disabled:bg-gray-800 dark:disabled:before:bg-gray-600 forced-colors:appearance-auto forced-colors:before:hidden"
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
                        name="{{ $name }}"
                        type="radio"
                        value="{{ $value }}"
                        @checked($selected === $value)
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
