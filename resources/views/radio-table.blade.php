@php
    use function Filament\Support\get_color_css_variables;

    $descriptions = $getDescriptions();
    $extras = $getExtras();
    $hiddenInputs = $getHiddenInputs();
    $colors = \Illuminate\Support\Arr::toCssStyles([
        get_color_css_variables($getColor(), shades: [50, 100, 200, 400, 500, 600, 700, 800]),
    ]);
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <fieldset class="relative -space-y-px rounded-md bg-white dark:bg-gray-900">
        @foreach($getOptions() as $value => $label)
            @php
                $id = $getId() . '-' . str($value)->slug();
                $description = $descriptions[$value] ?? '';
                $extra = $extras[$value] ?? null;
            @endphp

            <label
                for="{{ $id }}"
                class="group flex flex-col border border-gray-200 dark:border-gray-700 p-4
                       first:rounded-tl-md first:rounded-tr-md last:rounded-br-md last:rounded-bl-md
                       focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-custom-600
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
                        type="radio"
                        value="{{ $value }}"
                        wire:model="{{ $getStatePath() }}"
                        {{ ($isDisabled() || $isOptionDisabled($value, $label)) ? 'disabled' : '' }}
                        class="relative size-4 appearance-none rounded-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                               before:absolute before:inset-1 before:rounded-full before:bg-white dark:before:bg-gray-800
                               not-checked:before:hidden checked:border-custom-600 checked:bg-custom-600
                               focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-custom-600
                               disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400
                               dark:disabled:border-gray-700 dark:disabled:bg-gray-800 dark:disabled:before:bg-gray-600
                               forced-colors:appearance-auto forced-colors:before:hidden"
                    />
                    <span class="font-medium text-gray-900 dark:text-gray-100">
                        {{ $label }}
                    </span>
                </div>

                <div class="text-sm text-gray-500 dark:text-gray-400 md:text-left">
                    {{ $description }}
                </div>

                <div class="text-sm text-gray-500 dark:text-gray-400 md:text-right">
                    {{ $extra }}
                </div>
            </label>
        @endforeach
    </fieldset>
</x-dynamic-component>
