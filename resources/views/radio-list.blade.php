@php
    use function Filament\Support\get_color_css_variables;

    $descriptions = $getDescriptions();
    $extras = $getExtras();
    $colors = \Illuminate\Support\Arr::toCssStyles([
        get_color_css_variables($getColor(), shades: [50, 100, 200, 400, 500, 600, 700, 800]),
    ]);
    $hiddenInputs = $getHiddenInputs();
@endphp

<x-dynamic-component
        :component="$getFieldWrapperView()"
        :field="$field"
>
    <fieldset class="-space-y-px rounded-md bg-white dark:bg-gray-900">
        @foreach($getOptions() as $value => $label)
            @php
                $id = $getId() . '-' . $value;
                $description = $descriptions[$value] ?? null;
                $extra = $extras[$value] ?? null;
            @endphp

            <label
                    for="{{ $id }}"
                    class="group flex border border-gray-200 dark:border-gray-700 p-4 first:rounded-tl-md first:rounded-tr-md last:rounded-br-md last:rounded-bl-md focus:outline-hidden has-checked:relative has-checked:border-custom-200 dark:has-checked:border-custom-500 has-checked:bg-custom-50 dark:has-checked:bg-custom-800/10 has-disabled:opacity-60"
                    style="{{ $colors }}"
            >
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
                                    class="relative size-4 shrink-0 appearance-none rounded-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 before:absolute before:inset-1 before:rounded-full before:bg-white dark:before:bg-gray-800 not-checked:before:hidden checked:border-custom-600 checked:bg-custom-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-custom-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 dark:disabled:border-gray-700 dark:disabled:bg-gray-800 dark:disabled:before:bg-gray-600 forced-colors:appearance-auto forced-colors:before:hidden"
                            />
                        @endif
                        <span class="flex flex-col">
                            <span class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $label }}
                            </span>
                            @if ($description)
                                <span class="block text-sm text-gray-500 dark:text-gray-400">
                                    {{ $description }}
                                </span>
                            @endif
                        </span>
                    </div>
                    @if ($extra)
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $extra }}
                        </span>
                    @endif
                </div>
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
            </label>
        @endforeach
    </fieldset>
</x-dynamic-component>
