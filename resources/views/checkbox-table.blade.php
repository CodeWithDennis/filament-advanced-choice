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
                $description = $descriptions[$value] ?? '';
            @endphp

            <label
                for="{{ $id }}"
                aria-label="{{ $label }}"
                aria-description="{{ $description }}"
                class="fi-fo-checkbox-list-option group flex flex-col border border-gray-200 dark:border-gray-700 p-4
                       first:rounded-tl-md first:rounded-tr-md last:rounded-br-md last:rounded-bl-md
                       focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600
                       has-checked:relative has-checked:border-primary-200 dark:has-checked:border-primary-500
                       has-checked:bg-primary-50 dark:has-checked:bg-primary-800/10
                       has-disabled:opacity-60
                       md:grid md:grid-cols-2 md:pr-6 md:pl-4"
            >
                <span class="fi-fo-checkbox-list-option-text flex items-center gap-3 text-sm">
                    <input
                        id="{{ $id }}"
                        name="{{ $getName() }}"
                        type="checkbox"
                        value="{{ $value }}"
                        wire:model="{{ $getStatePath() }}"
                        {{ $isDisabled() ? 'disabled' : '' }}
                        class="fi-checkbox-input mt-0.5 shrink-0"
                    />
                    <span class="fi-fo-checkbox-list-option-label font-medium text-gray-900 dark:text-gray-100">
                        {{ $label }}
                    </span>
                </span>

                <span class="ml-6 pl-1 text-sm text-gray-500 dark:text-gray-400 md:ml-0 md:pl-0 md:text-right">
                    {{ $description }}
                </span>
            </label>
        @endforeach
    </fieldset>
</x-dynamic-component> 