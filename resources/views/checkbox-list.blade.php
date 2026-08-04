@php
    use function Filament\Support\get_color_css_variables;
    use Filament\Support\Enums\GridDirection;
    use Filament\Support\Facades\FilamentView;

    $descriptions = $getDescriptions();
    $extras = $getExtras();
    $colors = \Illuminate\Support\Arr::toCssStyles([
        get_color_css_variables($getColor(), shades: [50, 100, 200, 400, 500, 600, 700, 800]),
    ]);

    $fieldWrapperView = $getFieldWrapperView();
    $extraInputAttributeBag = $getExtraInputAttributeBag();
    $isHtmlAllowed = $isHtmlAllowed();
    $isBulkToggleable = $isBulkToggleable();
    $isDisabled = $isDisabled();
    $hasCursorPointer = $hasCursorPointer();
    $isSearchable = $isSearchable();
    $statePath = $getStatePath();
    $options = $getOptions();
    $livewireKey = $getLivewireKey();
    $wireModelAttribute = $applyStateBindingModifiers('wire:model');
    $hiddenInputs = $getHiddenInputs();
@endphp

<x-dynamic-component :component="$fieldWrapperView" :field="$field">
    <div
        @if (FilamentView::hasSpaMode())
            {{-- format-ignore-start --}}x-load="visible || event (x-modal-opened)"{{-- format-ignore-end --}}
        @else
            x-load
        @endif
        x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('checkbox-list', 'filament/forms') }}"
        x-data="checkboxListFormComponent({
                    livewireId: @js($this->getId()),
                })"
        {{ $getExtraAlpineAttributeBag()->class(['fi-fo-checkbox-list']) }}
    >
        @if (! $isDisabled)
            @if ($isSearchable)
                <x-filament::input.wrapper
                    inline-prefix
                    :prefix-icon="\Filament\Support\Icons\Heroicon::MagnifyingGlass"
                    prefix-icon-alias="forms:components.checkbox-list.search-field"
                    class="fi-fo-checkbox-list-search-input-wrp"
                >
                    <input
                        placeholder="{{ $getSearchPrompt() }}"
                        type="search"
                        x-model.debounce.{{ $getSearchDebounce() }}="search"
                        class="fi-input fi-input-has-inline-prefix"
                    />
                </x-filament::input.wrapper>
            @endif

            @if ($isBulkToggleable && count($options))
                <div
                    x-cloak
                    class="fi-fo-checkbox-list-actions"
                    wire:key="{{ $livewireKey }}.actions"
                >
                    <span
                        x-show="! areAllCheckboxesChecked"
                        x-on:click="toggleAllCheckboxes()"
                        wire:key="{{ $livewireKey }}.actions.select-all"
                    >
                        {{ $getAction('selectAll') }}
                    </span>

                    <span
                        x-show="areAllCheckboxesChecked"
                        x-on:click="toggleAllCheckboxes()"
                        wire:key="{{ $livewireKey }}.actions.deselect-all"
                    >
                        {{ $getAction('deselectAll') }}
                    </span>
                </div>
            @endif
        @endif

        <fieldset
            {{
                $getExtraAttributeBag()
                    ->merge([
                        'x-show' => $isSearchable ? 'visibleCheckboxListOptions.length' : null,
                    ], escape: false)
                    ->class([
                        'fi-fo-checkbox-list-options',
                        'm-0 flex min-w-0 flex-col gap-0 divide-y divide-gray-200 overflow-hidden rounded-md border border-gray-200 bg-white p-0 dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-900',
                    ])
            }}
        >
            @foreach ($options as $value => $label)
                @php
                    $id = str_replace('.', '-', $statePath) . '-' . $value;
                    $description = $descriptions[$value] ?? null;
                    $extra = $extras[$value] ?? null;
                @endphp

                <label
                    @if ($isSearchable)
                        wire:key="{{ $livewireKey }}.options.{{ $value }}"
                        x-show="
                            $el
                                .querySelector('.fi-fo-checkbox-list-option-label')
                                ?.innerText.toLowerCase()
                                .includes(search.toLowerCase()) ||
                                $el
                                    .querySelector('.fi-fo-checkbox-list-option-description')
                                    ?.innerText.toLowerCase()
                                    .includes(search.toLowerCase())
                        "
                    @endif
                        for="{{ $id }}"
                        @class([
                            'fi-fo-checkbox-list-option group flex p-4 focus:outline-hidden has-checked:relative has-checked:z-10 has-checked:bg-custom-50 dark:has-checked:bg-custom-800/10 has-disabled:opacity-60 has-disabled:cursor-not-allowed',
                            'not-has-disabled:cursor-pointer' => $hasCursorPointer,
                        ])
                        style="{{ $colors }}"
                    >
                        <div class="flex items-center justify-between w-full">
                            <div class="flex items-center gap-3">
                                @if(!$hiddenInputs)
                                    <input
                                        id="{{ $id }}"
                                        name="{{ $statePath }}"
                                        type="checkbox"
                                        value="{{ $value }}"
                                        {{
                                            $extraInputAttributeBag
                                                ->merge([
                                                    'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                                                    'wire:loading.attr' => 'disabled',
                                                    $wireModelAttribute => $statePath,
                                                    'x-on:change' => $isBulkToggleable ? 'checkIfAllCheckboxesAreChecked()' : null,
                                                ], escape: false)
                                                ->class([
                                                    'fi-checkbox-input cursor-[inherit] shrink-0 checked:bg-custom-500 checked:border-custom-500 hover:checked:bg-custom-600 hover:checked:border-custom-600 focus:border-custom-500 focus:ring-custom-500',
                                                    'fi-valid' => ! $errors->has($statePath),
                                                    'fi-invalid' => $errors->has($statePath),
                                                ])
                                        }}
                                        style="{{ $colors }}"
                                    />
                                @endif
                                <span class="fi-fo-checkbox-list-option-label flex flex-col">
                                    <span class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                                        @if ($isHtmlAllowed)
                                            {!! $label !!}
                                        @else
                                            {{ $label }}
                                        @endif
                                    </span>
                                    @if ($description)
                                        <span class="fi-fo-checkbox-list-option-description block text-sm text-gray-500 dark:text-gray-400">
                                            {{ $description }}
                                        </span>
                                    @endif
                                </span>
                            </div>
                            @if ($extra)
                                <span class="fi-fo-checkbox-list-option-extra text-sm text-gray-800 dark:text-gray-100">
                                    {{ $extra }}
                                </span>
                            @endif
                        </div>
                        @if($hiddenInputs)
                            <input
                                id="{{ $id }}"
                                name="{{ $statePath }}"
                                type="checkbox"
                                value="{{ $value }}"
                                {{
                                    $extraInputAttributeBag
                                        ->merge([
                                            'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                                            'wire:loading.attr' => 'disabled',
                                            $wireModelAttribute => $statePath,
                                            'x-on:change' => $isBulkToggleable ? 'checkIfAllCheckboxesAreChecked()' : null,
                                        ], escape: false)
                                        ->class([
                                            'absolute inset-0 cursor-[inherit] appearance-none focus:outline-none',
                                        ])
                                }}
                            />
                        @endif
                    </label>
                @endforeach
        </fieldset>

        @if ($isSearchable)
            <div
                x-cloak
                x-show="search && ! visibleCheckboxListOptions.length"
                class="fi-fo-checkbox-list-no-search-results-message"
            >
                {{ $getNoSearchResultsMessage() }}
            </div>
        @endif
    </div>
</x-dynamic-component>
