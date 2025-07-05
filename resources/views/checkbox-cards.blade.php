@php
    use function Filament\Support\get_color_css_variables;

    $descriptions = $getDescriptions();
    $extras = $getExtras();
    $colors = \Illuminate\Support\Arr::toCssStyles([
        get_color_css_variables($getColor(), shades: [50, 100, 400, 500, 600, 700, 800]),
    ]);
    $hiddenInputs = $getHiddenInputs();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <fieldset class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4">
        @foreach($getOptions() as $value => $label)
            @php
                $id = $getId() . '-' . $value;
                $description = $descriptions[$value] ?? null;
                $extra = $extras[$value] ?? null;
            @endphp

            <label
                for="{{ $id }}"
                class="group relative flex rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 p-4 has-checked:outline-2 has-checked:-outline-offset-2 has-checked:outline-custom-600 dark:has-checked:outline-custom-500 has-focus-visible:outline-3 has-focus-visible:-outline-offset-1 has-disabled:opacity-60"
                style="{{ $colors }}"
            >
                @if($hiddenInputs)
                    <input
                        id="{{ $id }}"
                        name="{{ $getName() }}"
                        type="checkbox"
                        value="{{ $value }}"
                        wire:model="{{ $getStatePath() }}"
                        {{ $isDisabled() ? 'disabled' : '' }}
                        class="absolute inset-0 appearance-none focus:outline-none"
                    />
                @endif
                <div class="fi-fo-checkbox-list-option-text flex-1">
                    <span class="fi-fo-checkbox-list-option-label block text-sm font-medium text-gray-900 dark:text-gray-100">{{ $label }}</span>
                    @if ($description)
                        <span class="mt-1 block text-sm text-gray-500 dark:text-gray-400">{{ $description }}</span>
                    @endif
                    @if ($extra)
                        <span class="mt-6 block text-sm font-medium text-gray-900 dark:text-gray-100">{{ $extra }}</span>
                    @endif
                </div>
                @if(!$hiddenInputs)
                    <input
                        id="{{ $id }}"
                        name="{{ $getName() }}"
                        type="checkbox"
                        value="{{ $value }}"
                        wire:model="{{ $getStatePath() }}"
                        {{ $isDisabled() ? 'disabled' : '' }}
                        class="fi-checkbox-input mt-0.5 shrink-0 ml-3 checked:bg-custom-500 checked:border-custom-500 hover:checked:bg-custom-600 hover:checked:border-custom-600 focus:border-custom-500 focus:ring-custom-500"
                        style="{{ $colors }}"
                    />
                @endif
                @if($hiddenInputs)
                    <svg class="invisible size-5 text-custom-600 dark:text-custom-500 group-has-checked:visible absolute top-2 right-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                    </svg>
                @endif
            </label>
        @endforeach
    </fieldset>
</x-dynamic-component>
