@php
    $descriptions = $getDescriptions();
    $extras = $getExtras();
    $columns = $getColumns(); // TODO: Use this to set the grid columns dynamically if needed
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <fieldset class="space-y-6">
        <div
            class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4"
        >
            @foreach($getOptions() as $value => $label)
                @php
                    $id = $getId() . '-' . $value;
                    $description = $descriptions[$value] ?? '';
                @endphp

                <label
                    for="{{ $id }}"
                    aria-label="{{ $label }}"
                    aria-description="{{ $description }}"
                    class="group relative flex rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-4
                           has-checked:outline-2 has-checked:-outline-offset-2 has-checked:outline-primary-600
                           focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600
                           has-disabled:border-gray-400 has-disabled:opacity-50 {{ $isDisabled() ? 'cursor-default' : 'cursor-pointer' }}"
                >
                    <input
                        id="{{ $id }}"
                        type="radio"
                        name="{{ $getName() }}"
                        value="{{ $value }}"
                        wire:model="{{ $getStatePath() }}"
                        {{ $isDisabled() ? 'disabled' : '' }}
                        class="{{ $isDisabled() ? 'cursor-default' : 'cursor-pointer' }} absolute inset-0 appearance-none focus:outline-none"
                    />
                    <div class="flex-1">
                        <span class="block text-sm font-medium text-gray-900 dark:text-gray-100 group-has-checked:text-primary-800 dark:group-has-checked:text-primary-300">
                            {{ $label }}
                        </span>
                        @if($description)
                            <span class="mt-1 block text-sm text-gray-500 dark:text-gray-400 group-has-checked:text-primary-600 dark:group-has-checked:text-primary-400">
                                {{ $description }}
                            </span>
                        @endif
                        @if($extra = $extras[$value])
                            <span class="mt-6 block text-sm font-medium text-gray-900 dark:text-gray-100 group-has-checked:text-primary-800 dark:group-has-checked:text-primary-300">
                                {{ $extra }}
                            </span>
                        @endif
                    </div>

                    <svg
                        class="invisible size-5 text-primary-600 dark:text-primary-400 group-has-checked:visible"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                        data-slot="icon"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </label>
            @endforeach
        </div>
    </fieldset>
</x-dynamic-component>
