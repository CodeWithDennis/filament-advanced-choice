@php
    use Filament\Support\Enums\GridDirection;use function Filament\Support\get_color_css_variables;
    use function Filament\Support\get_grid_columns_class;

    $descriptions = $getDescriptions();
    $extras = $getExtras();
    $colors = \Illuminate\Support\Arr::toCssStyles([
        get_color_css_variables($getColor(), shades: [50, 100, 400, 500, 600, 700, 800]),
    ]);
    $hiddenInputs = $getHiddenInputs();
    $columns = $getColumns();
    $gridDirection = $getGridDirection();
    $isInline = false;
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <fieldset
        {{
            $getExtraAttributeBag()
                ->when(! $isInline, fn ($attributes) => $attributes->grid($columns, $gridDirection))
                ->class([
                    'fi-fo-radio',
                    'gap-4',
                ])
        }}
    >
        @foreach($getOptions() as $value => $label)
            @php
                $id = $getId() . '-' . $value;
                $description = $descriptions[$value] ?? null;
                $extra = $extras[$value] ?? null;
            @endphp

            <label
                for="{{ $id }}"
                class="group relative block rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-6 py-4 has-checked:outline-1 has-checked:-outline-offset-1 has-checked:outline-custom-600 dark:has-checked:outline-custom-500 has-focus-visible:outline-3 has-focus-visible:-outline-offset-1 has-disabled:opacity-60 sm:flex sm:justify-between"
                style="{{ $colors }}"
            >
                @if($hiddenInputs)
                    <input
                        id="{{ $id }}"
                        name="{{ $getName() }}"
                        type="radio"
                        value="{{ $value }}"
                        wire:model="{{ $getStatePath() }}"
                        {{ ($isDisabled() || $isOptionDisabled($value, $label)) ? 'disabled' : '' }}
                        class="absolute inset-0 appearance-none focus:outline-none"
                    />
                @endif
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center gap-3">
                        @if(!$hiddenInputs)
                            <input
                                id="{{ $id }}"
                                name="{{ $getName() }}"
                                type="radio"
                                value="{{ $value }}"
                                wire:model="{{ $getStatePath() }}"
                                {{ ($isDisabled() || $isOptionDisabled($value, $label)) ? 'disabled' : '' }}
                                class="relative size-4 shrink-0 appearance-none rounded-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 before:absolute before:inset-1 before:rounded-full before:bg-white dark:before:bg-gray-800 not-checked:before:hidden checked:border-custom-600 checked:bg-custom-600 focus-visible:outline-1 focus-visible:outline-offset-1 focus-visible:outline-custom-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 dark:disabled:border-gray-700 dark:disabled:bg-gray-800 dark:disabled:before:bg-gray-600 forced-colors:appearance-auto forced-colors:before:hidden"
                            />
                        @endif
                        <span class="flex items-center">
                            <span class="flex flex-col text-sm">
                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $label }}</span>
                                @if ($description)
                                    <span class="text-gray-500 dark:text-gray-400">
                                        {{ $description }}
                                    </span>
                                @endif
                            </span>
                        </span>
                    </div>
                    @if ($extra)
                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $extra }}</span>
                    @endif
                </div>
                @if($hiddenInputs)
                    <svg class="invisible size-5 text-custom-600 dark:text-custom-500 group-has-checked:visible absolute top-2 right-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd"/>
                    </svg>
                @endif
            </label>
        @endforeach
    </fieldset>
</x-dynamic-component>
