@php
    $colorMap = [
        'primary' => ['50' => '#eef2ff', '100' => '#e0e7ff', '200' => '#c7d2fe', '400' => '#818cf8', '500' => '#6366f1', '600' => '#4f46e5', '700' => '#4338ca', '800' => '#3730a3'],
        'danger' => ['50' => '#fef2f2', '100' => '#fee2e2', '200' => '#fecaca', '400' => '#f87171', '500' => '#ef4444', '600' => '#dc2626', '700' => '#b91c1c', '800' => '#991b1b'],
        'warning' => ['50' => '#fffbeb', '100' => '#fef3c7', '200' => '#fde68a', '400' => '#fbbf24', '500' => '#f59e0b', '600' => '#d97706', '700' => '#b45309', '800' => '#92400e'],
        'success' => ['50' => '#f0fdf4', '100' => '#dcfce7', '200' => '#bbf7d0', '400' => '#4ade80', '500' => '#22c55e', '600' => '#16a34a', '700' => '#15803d', '800' => '#166534'],
        'info' => ['50' => '#eff6ff', '100' => '#dbeafe', '200' => '#bfdbfe', '400' => '#60a5fa', '500' => '#3b82f6', '600' => '#2563eb', '700' => '#1d4ed8', '800' => '#1e40af'],
    ];

    $shades = $colorMap[$color] ?? $colorMap['primary'];
    $colors = collect($shades)
        ->map(fn ($hex, $shade) => "--c-{$shade}:{$hex}")
        ->implode(';');

    $wireAttrs = $attributes->whereStartsWith('wire:');
@endphp

<div
    x-data="{ search: '' }"
    class="fi-fo-checkbox-list"
>
    @if ($searchable)
        <div class="fi-fo-checkbox-list-search-input-wrp mb-3">
            <input
                placeholder="{{ $searchPrompt }}"
                type="search"
                x-model="search"
                class="fi-input w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-sm shadow-sm"
            />
        </div>
    @endif

    <fieldset
        @if ($searchable)
            x-show="search ? !!visibleOptionsCount : true"
            x-init="
                const labels = $el.querySelectorAll('label');
                $watch('search', value => {
                    let count = 0;
                    labels.forEach(l => {
                        const match = !value ||
                            l.querySelector('.option-label')?.innerText?.toLowerCase().includes(value.toLowerCase()) ||
                            l.querySelector('.option-description')?.innerText?.toLowerCase().includes(value.toLowerCase());
                        l.style.display = match ? '' : 'none';
                        if (match) count++;
                    });
                    visibleOptionsCount = count;
                });
                visibleOptionsCount = labels.length;
            "
        @endif
        class="fi-fo-checkbox-list-options -space-y-px rounded-md bg-white dark:bg-gray-900"
    >
        @foreach ($options as $value => $label)
            @php
                $id = $name . '-' . $value;
                $description = $descriptions[$value] ?? null;
                $extra = $extras[$value] ?? null;
            @endphp

            <label
                for="{{ $id }}"
                @class([
                    'fi-fo-checkbox-list-option group flex border border-gray-200 dark:border-gray-700 p-4 first:rounded-tl-md first:rounded-tr-md last:rounded-br-md last:rounded-bl-md focus:outline-hidden has-checked:relative has-checked:border-custom-200 dark:has-checked:border-custom-500 has-checked:bg-custom-50 dark:has-checked:bg-custom-800/10 has-disabled:opacity-60 has-disabled:cursor-not-allowed',
                    'not-has-disabled:cursor-pointer' => $cursorPointer,
                ])
                style="{{ $colors }}"
            >
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center gap-3">
                        @if (!$hiddenInputs)
                            <input
                                id="{{ $id }}"
                                name="{{ $name }}"
                                type="radio"
                                value="{{ $value }}"
                                @checked($selected === $value)
                                {{ $wireAttrs }}
                                class="relative size-4 shrink-0 appearance-none rounded-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 before:absolute before:inset-1 before:rounded-full before:bg-white dark:before:bg-gray-800 not-checked:before:hidden checked:border-custom-600 checked:bg-custom-600 focus-visible:outline-1 focus-visible:outline-offset-1 focus-visible:outline-custom-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 dark:disabled:border-gray-700 dark:disabled:bg-gray-800 dark:disabled:before:bg-gray-600 forced-colors:appearance-auto forced-colors:before:hidden"
                            />
                        @endif
                        <span class="flex flex-col">
                            <span class="option-label block text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $label }}
                            </span>
                            @if ($description)
                                <span class="option-description block text-sm text-gray-500 dark:text-gray-400">
                                    {{ $description }}
                                </span>
                            @endif
                        </span>
                    </div>
                    @if ($extra)
                        <span class="text-sm text-gray-800 dark:text-gray-100">
                            {{ $extra }}
                        </span>
                    @endif
                </div>
                @if ($hiddenInputs)
                    <input
                        id="{{ $id }}"
                        name="{{ $name }}"
                        type="radio"
                        value="{{ $value }}"
                        @checked($selected === $value)
                        {{ $wireAttrs }}
                        class="absolute inset-0 appearance-none focus:outline-none"
                    />
                @endif
            </label>
        @endforeach
    </fieldset>

    @if ($searchable)
        <div
            x-cloak
            x-show="search && !visibleOptionsCount"
            class="fi-fo-checkbox-list-no-search-results-message px-3 py-2 text-sm text-gray-500"
        >
            {{ $noSearchResultsMessage }}
        </div>
    @endif
</div>
