@php
    use function Filament\Support\get_color_css_variables;
    use Filament\Support\Facades\FilamentView;

    $descriptions = $getDescriptions();
    $extras = $getExtras();
    $images = $getImages();
    $colors = \Illuminate\Support\Arr::toCssStyles([
        get_color_css_variables($getColor(), shades: [50, 100, 400, 500, 600, 700, 800]),
    ]);
    $hiddenInputs = $getHiddenInputs();
    $columns = $getColumns();
    $gridDirection = $getGridDirection();
    $isInline = false;
    $enum = $getEnum();
    $isDisabled = $isDisabled();
    $hasCursorPointer = $hasCursorPointer();
    $isSearchable = $isSearchable();
    $statePath = $getStatePath();
    $options = $getOptions();
    $livewireKey = $getLivewireKey();
    $extraInputAttributeBag = $getExtraInputAttributeBag();
    $wireModelAttribute = $applyStateBindingModifiers('wire:model');
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
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
        class="fi-fo-checkbox-list"
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
                        x-model="search"
                        class="fi-input fi-input-has-inline-prefix"
                    />
                </x-filament::input.wrapper>
            @endif
        @endif

        <fieldset
            {{
                $getExtraAttributeBag()
                    ->when(! $isInline, fn ($attributes) => $attributes->grid($columns, $gridDirection))
                    ->merge([
                        'x-show' => $isSearchable ? 'visibleCheckboxListOptions.length' : null,
                    ], escape: false)
                    ->class([
                        'fi-fo-checkbox-list-options',
                        'fi-fo-radio',
                        'gap-4',
                    ])
            }}
        >
            @foreach ($options as $value => $label)
                @php
                    $id = str_replace('.', '-', $statePath) . '-' . $value;
                    $description = $descriptions[$value] ?? null;
                    $extra = $extras[$value] ?? null;
                    $imageUrl = $images[$value] ?? null;
                    if ($enum) {
                        $case = $getEnum()::tryFrom($value) ?: null;

                        if ($case && method_exists($case, 'getColor') && $color = $case->getColor()) {
                            $colors = \Illuminate\Support\Arr::toCssStyles([
                                get_color_css_variables($color, shades: [50, 100, 400, 500, 600, 700, 800]),
                            ]);
                        }
                    }
                @endphp

                <div
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
                    class="fi-fo-checkbox-list-option-ctn"
                >
                    <label
                        for="{{ $id }}"
                        @class([
                            'fi-fo-checkbox-list-option group relative flex flex-col overflow-hidden rounded-lg border border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-900 has-checked:outline-2 has-checked:-outline-offset-1 has-checked:outline-custom-600 dark:has-checked:outline-custom-500 has-disabled:opacity-60 has-disabled:cursor-not-allowed',
                            'not-has-disabled:cursor-pointer' => $hasCursorPointer,
                        ])
                        style="{{ $colors }}"
                    >
                        @if ($hiddenInputs)
                            <input
                                id="{{ $id }}"
                                name="{{ $statePath }}"
                                type="radio"
                                value="{{ $value }}"
                                {{
                                    $getExtraInputAttributeBag()
                                        ->merge([
                                            'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                                            'wire:loading.attr' => 'disabled',
                                            $wireModelAttribute => $statePath,
                                        ], escape: false)
                                        ->class([
                                            'absolute inset-0 appearance-none focus:outline-none',
                                        ])
                                }}
                            />
                        @endif
                        <div class="aspect-[4/3] w-full overflow-hidden bg-gray-100 dark:bg-gray-800">
                            @if ($imageUrl)
                                <img
                                    src="{{ $imageUrl }}"
                                    alt=""
                                    class="size-full object-cover"
                                    loading="lazy"
                                />
                            @endif
                        </div>
                        <div class="fi-fo-checkbox-list-option-text flex flex-1 flex-col p-4">
                            <span
                                class="fi-fo-checkbox-list-option-label block text-sm font-medium text-gray-900 dark:text-gray-100"
                            >
                                {{ $label }}
                            </span>
                            @if ($description)
                                <span
                                    class="fi-fo-checkbox-list-option-description mt-1 block text-sm text-gray-500 dark:text-gray-400"
                                >
                                    {{ $description }}
                                </span>
                            @endif
                            @if ($extra)
                                <span
                                    class="fi-fo-checkbox-list-option-extra mt-3 block text-sm font-medium text-gray-900 dark:text-gray-100"
                                >
                                    {{ $extra }}
                                </span>
                            @endif
                        </div>
                        @if (! $hiddenInputs)
                            <input
                                id="{{ $id }}"
                                name="{{ $statePath }}"
                                type="radio"
                                value="{{ $value }}"
                                {{
                                    $getExtraInputAttributeBag()
                                        ->merge([
                                            'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                                            'wire:loading.attr' => 'disabled',
                                            $wireModelAttribute => $statePath,
                                        ], escape: false)
                                        ->class([
                                            'fi-radio-input absolute end-3 top-3 size-4 shrink-0 checked:bg-custom-500 checked:border-custom-500 hover:checked:bg-custom-600 hover:checked:border-custom-600 focus:border-custom-500 focus:ring-custom-500',
                                            'fi-valid' => ! $errors->has($statePath),
                                            'fi-invalid' => $errors->has($statePath),
                                        ])
                                }}
                                style="{{ $colors }}"
                            />
                        @endif
                        @if ($hiddenInputs)
                            <x-filament::icon
                                :icon="$getHiddenInputIcon()"
                                class="invisible absolute end-2 top-2 size-5 text-custom-600 group-has-checked:visible dark:text-custom-500"
                            />
                        @endif
                    </label>
                </div>
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
