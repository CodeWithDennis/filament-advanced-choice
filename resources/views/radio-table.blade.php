@php
    $descriptions = $getDescriptions();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <fieldset aria-label="{{ $getLabel() }}" class="relative -space-y-px rounded-md bg-white dark:bg-gray-900">
        @foreach($getOptions() as $value => $label)
            @php
                $id = $getId() . '-' . str($value)->slug();
            @endphp

            <label
                for="{{ $id }}"
                aria-label="{{ $label }}"
                aria-description="{{ $descriptions[$value] ?? '' }}"
                class="group flex flex-col border border-gray-200 dark:border-gray-700 p-4
                       first:rounded-tl-md first:rounded-tr-md last:rounded-br-md last:rounded-bl-md
                       focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600
                       has-checked:relative has-checked:border-primary-200 dark:has-checked:border-primary-500
                       has-checked:bg-primary-50 dark:has-checked:bg-primary-800/10
                       md:grid md:grid-cols-2 md:pr-6 md:pl-4"
            >
                <span class="flex items-center gap-3 text-sm">
                    <input
                        id="{{ $id }}"
                        name="{{ $getName() }}"
                        type="radio"
                        value="{{ $value }}"
                        wire:model="{{ $getStatePath() }}"
                        {{ $isDisabled() ? 'disabled' : '' }}
                        class="relative size-4 appearance-none rounded-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                               before:absolute before:inset-1 before:rounded-full before:bg-white dark:before:bg-gray-800
                               not-checked:before:hidden checked:border-primary-600 checked:bg-primary-600
                               focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600
                               disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400
                               dark:disabled:border-gray-700 dark:disabled:bg-gray-800 dark:disabled:before:bg-gray-600
                               forced-colors:appearance-auto forced-colors:before:hidden"
                    />
                    <span class="font-medium text-gray-900 dark:text-gray-100">
                        {{ $label }}
                    </span>
                </span>

                <span class="ml-6 pl-1 text-sm text-gray-500 dark:text-gray-400 md:ml-0 md:pl-0 md:text-right">
                    {{ $descriptions[$value] ?? '' }}
                </span>
            </label>
        @endforeach
    </fieldset>
</x-dynamic-component>
