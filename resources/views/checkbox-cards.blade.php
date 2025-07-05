@php
    $descriptions = $getDescriptions();
    $extras = $getExtras();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <fieldset aria-label="{{ $getLabel() }}" class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4">
        @foreach($getOptions() as $value => $label)
            @php
                $id = $getId() . '-' . $value;
                $description = $descriptions[$value] ?? null;
                $extra = $extras[$value] ?? null;
            @endphp

            <label 
                for="{{ $id }}"
                aria-label="{{ $label }}" 
                aria-description="{{ $description }}"
                class="group relative flex rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 p-4 has-checked:outline-2 has-checked:-outline-offset-2 has-checked:outline-primary-600 dark:has-checked:outline-primary-500 has-focus-visible:outline-3 has-focus-visible:-outline-offset-1 has-disabled:opacity-60"
            >
                <input 
                    id="{{ $id }}"
                    name="{{ $getName() }}"
                    type="checkbox" 
                    value="{{ $value }}"
                    wire:model="{{ $getStatePath() }}"
                    {{ $isDisabled() ? 'disabled' : '' }}
                    class="absolute inset-0 appearance-none focus:outline-none" 
                />
                <div class="fi-fo-checkbox-list-option-text flex-1">
                    <span class="fi-fo-checkbox-list-option-label block text-sm font-medium text-gray-900 dark:text-gray-100">{{ $label }}</span>
                    @if ($description)
                        <span class="mt-1 block text-sm text-gray-500 dark:text-gray-400">{{ $description }}</span>
                    @endif
                    @if ($extra)
                        <span class="mt-6 block text-sm font-medium text-gray-900 dark:text-gray-100">{{ $extra }}</span>
                    @endif
                </div>
                <svg class="invisible size-5 text-primary-600 dark:text-primary-500 group-has-checked:visible absolute top-2 right-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                </svg>
            </label>
        @endforeach
    </fieldset>
</x-dynamic-component> 