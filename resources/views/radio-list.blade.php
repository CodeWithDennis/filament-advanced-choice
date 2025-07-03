@php
    $descriptions = $getDescriptions();
@endphp

<x-dynamic-component
        :component="$getFieldWrapperView()"
        :field="$field"
>
    <fieldset aria-label="{{ $getLabel() }}" class="-space-y-px rounded-md bg-white dark:bg-gray-900">
        @foreach($getOptions() as $value => $label)
            @php
                $id = $getId() . '-' . $value;
            @endphp

            <label
                    for="{{ $id }}"
                    class="group flex {{ $isDisabled() ? 'cursor-default' : 'cursor-pointer' }} border border-gray-200 dark:border-gray-700 p-4 first:rounded-tl-md first:rounded-tr-md last:rounded-br-md last:rounded-bl-md focus:outline-hidden has-checked:relative has-checked:border-primary-200 dark:has-checked:border-primary-500 has-checked:bg-primary-50 dark:has-checked:bg-primary-800/10"
            >
                <input
                        id="{{ $id }}"
                        name="{{ $getName() }}"
                        type="radio"
                        value="{{ $value }}"
                        wire:model="{{ $getStatePath() }}"
                        {{ $isDisabled() ? 'disabled' : '' }}
                        class="relative mt-0.5 size-4 shrink-0 appearance-none rounded-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 before:absolute before:inset-1 before:rounded-full before:bg-white dark:before:bg-gray-800 not-checked:before:hidden checked:border-primary-600 checked:bg-primary-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 dark:disabled:border-gray-700 dark:disabled:bg-gray-800 dark:disabled:before:bg-gray-600 forced-colors:appearance-auto forced-colors:before:hidden"
                />

                <span class="ml-3 flex flex-col">
                    <span class="block text-sm font-medium text-gray-900 dark:text-gray-100 group-has-checked:text-primary-800 dark:group-has-checked:text-primary-300">
                        {{ $label }}
                    </span>
                    @if (!empty($descriptions[$value]))
                        <span class="block text-sm text-gray-500 dark:text-gray-400 group-has-checked:text-primary-600 dark:group-has-checked:text-primary-400">
                            {{ $descriptions[$value] }}
                        </span>
                    @endif
                </span>
            </label>
        @endforeach
    </fieldset>
</x-dynamic-component>
