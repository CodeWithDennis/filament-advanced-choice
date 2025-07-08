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
    $isSearchable = $isSearchable();
    $statePath = $getStatePath();
    $options = $getOptions();
    $livewireKey = $getLivewireKey();
    $wireModelAttribute = $applyStateBindingModifiers('wire:model');
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
                        'relative -space-y-px rounded-md bg-white dark:bg-gray-900',
                    ])
            }}
        >
            @foreach ($options as $value => $label)
                @php
                    $id = $getId() . '-' . str($value)->slug();
                    $description = $descriptions[$value] ?? '';
                    $extra = $extras[$value] ?? null;
                @endphp

                                    <label
                        wire:key="{{ $livewireKey }}.options.{{ $value }}"
                        @if ($isSearchable)
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
                            class="fi-fo-checkbox-list-option group flex flex-col border border-gray-200 dark:border-gray-700 p-4
                                   first:rounded-tl-md first:rounded-tr-md last:rounded-br-md last:rounded-bl-md
                                   focus-visible:outline-1 focus-visible:outline-offset-1 focus-visible:outline-custom-600
                                   has-checked:relative has-checked:border-custom-200 dark:has-checked:border-custom-500
                                   has-checked:bg-custom-50 dark:has-checked:bg-custom-800/10
                                   has-disabled:opacity-60
                                   md:grid md:grid-cols-3 md:items-center md:pr-6 md:pl-4"
                            style="{{ $colors }}"
                        >
                            <div class="flex items-center gap-3 text-sm">
                                <input
                                    id="{{ $id }}"
                                    name="{{ $getName() }}"
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
                                                'fi-checkbox-input mt-0.5 shrink-0 checked:bg-custom-500 checked:border-custom-500 hover:checked:bg-custom-600 hover:checked:border-custom-600 focus:border-custom-500 focus:ring-custom-500',
                                                'fi-valid' => ! $errors->has($statePath),
                                                'fi-invalid' => $errors->has($statePath),
                                            ])
                                    }}
                                    style="{{ $colors }}"
                                />
                                <span class="fi-fo-checkbox-list-option-label font-medium text-gray-900 dark:text-gray-100">
                                    @if ($isHtmlAllowed)
                                        {!! $label !!}
                                    @else
                                        {{ $label }}
                                    @endif
                                </span>
                            </div>

                            <div class="fi-fo-checkbox-list-option-description text-sm text-gray-800 dark:text-gray-100 md:text-left">
                                {{ $description }}
                            </div>

                            <div class="fi-fo-checkbox-list-option-extra text-sm text-gray-800 dark:text-gray-100 md:text-right">
                                {{ $extra }}
                            </div>
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
