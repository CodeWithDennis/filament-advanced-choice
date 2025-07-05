@php
    $descriptions = $getDescriptions();
    $extras = $getExtras();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <fieldset aria-label="{{ $getLabel() }}" class="space-y-4">
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
                class="group relative block rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-6 py-4 has-checked:outline-2 has-checked:-outline-offset-2 has-checked:outline-primary-600 dark:has-checked:outline-primary-500 has-focus-visible:outline-3 has-focus-visible:-outline-offset-1 has-disabled:opacity-60 sm:flex sm:justify-between"
            >
                <input 
                    id="{{ $id }}"
                    name="{{ $getName() }}"
                    type="radio" 
                    value="{{ $value }}"
                    wire:model="{{ $getStatePath() }}"
                    {{ $isDisabled() ? 'disabled' : '' }}
                    class="absolute inset-0 appearance-none focus:outline-none" 
                />
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
                                @if ($extra)
                    <span class="mt-2 flex text-sm sm:mt-0 sm:ml-4 sm:flex-col sm:text-right sm:justify-center">
                        <span class="font-medium text-gray-900 dark:text-gray-100">{{ $extra }}</span>
                    </span>
                @endif
    </label>
        @endforeach
</fieldset>
</x-dynamic-component>
