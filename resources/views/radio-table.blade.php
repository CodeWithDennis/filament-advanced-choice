@php
    use function Filament\Support\get_color_css_variables;
    use Filament\Support\Facades\FilamentView;

    $descriptions = $getDescriptions();
    $extras = $getExtras();
    $hiddenInputs = $getHiddenInputs();
    $colors = \Illuminate\Support\Arr::toCssStyles([
        get_color_css_variables($getColor(), shades: [50, 100, 200, 400, 500, 600, 700, 800]),
    ]);
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
            'relative m-0 flex min-w-0 flex-col gap-0 divide-y divide-gray-200 overflow-hidden rounded-md border border-gray-200 bg-white p-0 dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-900',
        ])
            }}>
            @foreach($getOptions() as $value => $label)
                    @php
                        $id = str_replace('.', '-', $statePath) . '-' . str($value)->slug();
                        $description = $descriptions[$value] ?? '';
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
                    " @endif for="{{ $id }}" @class([
                        'fi-fo-checkbox-list-option group flex flex-col p-4
                         focus-visible:outline-1 focus-visible:outline-offset-1 focus-visible:outline-custom-600
                         has-checked:relative has-checked:z-10
                         has-checked:bg-custom-50 dark:has-checked:bg-custom-800/10
                         has-disabled:opacity-60 has-disabled:cursor-not-allowed
                         md:grid md:grid-cols-3 md:items-center md:pr-6 md:pl-4',
                        'not-has-disabled:cursor-pointer' => $hasCursorPointer,
                    ]) style="{{ $colors }}">
                        <div class="flex items-center gap-3 text-sm">
                            <input id="{{ $id }}" name="{{ $statePath }}" type="radio" value="{{ $value }}" {{
                $extraInputAttributeBag
                    ->merge([
                        'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                        'wire:loading.attr' => 'disabled',
                        $wireModelAttribute => $statePath,
                    ], escape: false)
                    ->class([
                        'relative size-4 appearance-none rounded-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 before:absolute before:inset-1 before:rounded-full before:bg-white dark:before:bg-gray-800 not-checked:before:hidden checked:border-custom-600 checked:bg-custom-600 focus-visible:outline-1 focus-visible:outline-offset-1 focus-visible:outline-custom-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 dark:disabled:border-gray-700 dark:disabled:bg-gray-800 dark:disabled:before:bg-gray-600 forced-colors:appearance-auto forced-colors:before:hidden',
                    ])
                                        }} />
                            <span class="fi-fo-checkbox-list-option-label font-medium text-gray-900 dark:text-gray-100">
                                {{ $label }}
                            </span>
                        </div>

                        <div
                            class="fi-fo-checkbox-list-option-description text-sm text-gray-800 dark:text-gray-100 md:text-left">
                            {{ $description }}
                        </div>

                        <div class="text-sm text-gray-800 dark:text-gray-100 md:text-right">
                            {{ $extra }}
                        </div>
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