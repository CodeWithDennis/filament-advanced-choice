@php
    $descriptions = $getDescriptions();
    $extras = $getExtras();
@endphp

<x-dynamic-component
        :component="$getFieldWrapperView()"
        :field="$field"
>
    <fieldset aria-label="{{ $getLabel() }}" class="-space-y-px rounded-md bg-white dark:bg-gray-900">
        @foreach($getOptions() as $value => $label)
            @php
                $id = $getId() . '-' . $value;
                $description = $descriptions[$value] ?? null;
                $extra = $extras[$value] ?? null;
            @endphp

            <label
                    for="{{ $id }}"
                    class="fi-fo-checkbox-list-option group flex border border-gray-200 dark:border-gray-700 p-4 first:rounded-tl-md first:rounded-tr-md last:rounded-br-md last:rounded-bl-md focus:outline-hidden has-checked:relative has-checked:border-primary-200 dark:has-checked:border-primary-500 has-checked:bg-primary-50 dark:has-checked:bg-primary-800/10 has-disabled:opacity-60"
            >
                <input
                        id="{{ $id }}"
                        name="{{ $getName() }}"
                        type="checkbox"
                        value="{{ $value }}"
                        wire:model="{{ $getStatePath() }}"
                        {{ $isDisabled() ? 'disabled' : '' }}
                        class="fi-checkbox-input mt-0.5 shrink-0"
                />
                <div class="fi-fo-checkbox-list-option-text ml-3 flex justify-between items-center w-full">
                    <span class="fi-fo-checkbox-list-option-label flex flex-col">
                        <span class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $label }}
                        </span>
                        @if ($description)
                            <span class="block text-sm text-gray-500 dark:text-gray-400">
                                {{ $description }}
                            </span>
                        @endif
                    </span>
                    @if ($extra)
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $extra }}
                        </span>
                    @endif
                </div>
            </label>
        @endforeach
    </fieldset>
</x-dynamic-component> 