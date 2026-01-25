@php
    use function Filament\Support\get_color_css_variables;
    use Filament\Support\Facades\FilamentView;

    $descriptions = $getDescriptions();
    $extras = $getExtras();
    $colors = \Illuminate\Support\Arr::toCssStyles([
        get_color_css_variables($getColor(), shades: [50, 100, 200, 400, 500, 600, 700, 800]),
    ]);
    $hiddenInputs = $getHiddenInputs();
    $enum = $getEnum();
    $isDisabled = $isDisabled();
    $isSearchable = $isSearchable();
    $statePath = $getStatePath();
    $options = $getOptions();
    $livewireKey = $getLivewireKey();
    $extraInputAttributeBag = $getExtraInputAttributeBag();
    $wireModelAttribute = $applyStateBindingModifiers('wire:model');
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div @if (FilamentView::hasSpaMode()) {{-- format-ignore-start --}}x-load="visible || event (x-modal-opened)" {{--
    format-ignore-end --}} @else x-load @endif
        x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('checkbox-list', 'filament/forms') }}"
        x-data="checkboxListFormComponent({
                    livewireId: @js($this->getId()),
                })" class="fi-fo-checkbox-list">
        @if (!$isDisabled)
            @if ($isSearchable)
                <x-filament::input.wrapper inline-prefix :prefix-icon="\Filament\Support\Icons\Heroicon::MagnifyingGlass"
                    prefix-icon-alias="forms:components.checkbox-list.search-field"
                    class="fi-fo-checkbox-list-search-input-wrp">
                    <input placeholder="{{ $getSearchPrompt() }}" type="search" x-model="search"
                        class="fi-input fi-input-has-inline-prefix" />
                </x-filament::input.wrapper>
            @endif
        @endif
        <fieldset {{
    $getExtraAttributeBag()
        ->merge([
            'x-show' => $isSearchable ? 'visibleCheckboxListOptions.length' : null,
        ], escape: false)
        ->class([
            'fi-fo-checkbox-list-options',
            '-space-y-px rounded-md bg-white dark:bg-gray-900',
        ])
            }}>
            @foreach($getOptions() as $value => $label)
                @php
                    $id = str_replace('.', '-', $statePath) . '-' . $value;
                    $description = $descriptions[$value] ?? null;
                    $extra = $extras[$value] ?? null;
                    if ($enum) {
                        $case = $getEnum()::tryFrom($value) ?: null;

                        if ($case && method_exists($case, 'getColor') && $color = $case->getColor()) {
                            $colors = \Illuminate\Support\Arr::toCssStyles([
                                get_color_css_variables($color, shades: [50, 100, 200, 400, 500, 600, 700, 800])
                            ]);
                        }
                    }
                @endphp

                <label @if ($isSearchable) wire:key="{{ $livewireKey }}.options.{{ $value }}" x-show="
                    $el
                        .querySelector('.fi-fo-checkbox-list-option-label')
                        ?.innerText.toLowerCase()
                        .includes(search.toLowerCase()) ||
                        $el
                            .querySelector('.fi-fo-checkbox-list-option-description')
                            ?.innerText.toLowerCase()
                            .includes(search.toLowerCase())
                " @endif for="{{ $id }}"
                    class="fi-fo-checkbox-list-option group flex border border-gray-200 dark:border-gray-700 p-4 first:rounded-tl-md first:rounded-tr-md last:rounded-br-md last:rounded-bl-md focus:outline-hidden has-checked:relative has-checked:border-custom-200 dark:has-checked:border-custom-500 has-checked:bg-custom-50 dark:has-checked:bg-custom-800/10 has-disabled:opacity-60"
                    style="{{ $colors }}">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center gap-3">
                            @if(!$hiddenInputs)
                                            <input id="{{ $id }}" name="{{ $statePath }}" type="radio" value="{{ $value }}" {{
                                $extraInputAttributeBag
                                    ->merge([
                                        'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                                        'wire:loading.attr' => 'disabled',
                                        $wireModelAttribute => $statePath,
                                    ], escape: false)
                                    ->class([
                                        'relative size-4 shrink-0 appearance-none rounded-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 before:absolute before:inset-1 before:rounded-full before:bg-white dark:before:bg-gray-800 not-checked:before:hidden checked:border-custom-600 checked:bg-custom-600 focus-visible:outline-1 focus-visible:outline-offset-1 focus-visible:outline-custom-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 dark:disabled:border-gray-700 dark:disabled:bg-gray-800 dark:disabled:before:bg-gray-600 forced-colors:appearance-auto forced-colors:before:hidden',
                                    ])
                                                                                                                    }} />
                            @endif
                            <span class="fi-fo-checkbox-list-option-label flex flex-col">
                                <span class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $label }}
                                </span>
                                @if ($description)
                                    <span
                                        class="fi-fo-checkbox-list-option-description block text-sm text-gray-500 dark:text-gray-400">
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
                            <input id="{{ $id }}" name="{{ $statePath }}" type="radio" value="{{ $value }}" {{
                        $extraInputAttributeBag
                            ->merge([
                                'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                                'wire:loading.attr' => 'disabled',
                                $wireModelAttribute => $statePath,
                            ], escape: false)
                            ->class([
                                'absolute inset-0 appearance-none focus:outline-none',
                            ])
                                                                            }} />
                    @endif
                </label>
            @endforeach
        </fieldset>

        @if ($isSearchable)
            <div x-cloak x-show="search && ! visibleCheckboxListOptions.length"
                class="fi-fo-checkbox-list-no-search-results-message">
                {{ $getNoSearchResultsMessage() }}
            </div>
        @endif
    </div>
</x-dynamic-component>