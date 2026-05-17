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
    $selectedArray = (array) $selected;
@endphp

<div
    x-data="{
        search: '',
        allChecked: false,
        visibleOptionsCount: {{ count($options) }},
        toggleAll() {
            this.allChecked = !this.allChecked;
            $el.querySelectorAll('input[type=checkbox][name=\'{{ $name }}[]\']').forEach(cb => {
                cb.checked = this.allChecked;
                cb.dispatchEvent(new Event('change', { bubbles: true }));
            });
        },
        checkIfAllChecked() {
            const all = $el.querySelectorAll('input[type=checkbox][name=\'{{ $name }}[]\']');
            this.allChecked = all.length > 0 && [...all].every(cb => cb.checked);
        },
        filterOptions() {
            let count = 0;
            $el.querySelectorAll('[data-checkbox-option]').forEach(el => {
                const value = this.search.toLowerCase();
                const match = !value ||
                    el.querySelector('.option-label')?.innerText?.toLowerCase().includes(value) ||
                    el.querySelector('.option-description')?.innerText?.toLowerCase().includes(value);
                el.style.display = match ? '' : 'none';
                if (match) count++;
            });
            this.visibleOptionsCount = count;
        }
    }"
    @if ($searchable)
        x-init="$watch('search', () => filterOptions())"
    @endif
    class="fi-fo-checkbox-list"
>
    @if ($bulkToggleable && count($options))
        <div
            x-cloak
            class="fi-fo-checkbox-list-actions mb-2"
        >
            <button
                type="button"
                x-show="!allChecked"
                x-on:click="toggleAll()"
                class="text-sm text-custom-600 dark:text-custom-400 hover:underline focus:outline-none"
                style="color: {{ $shades['600'] }}"
            >
                Select All
            </button>
            <button
                type="button"
                x-show="allChecked"
                x-on:click="toggleAll()"
                class="text-sm text-custom-600 dark:text-custom-400 hover:underline focus:outline-none"
                style="color: {{ $shades['600'] }}"
            >
                Deselect All
            </button>
        </div>
    @endif

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
            x-show="search ? visibleOptionsCount > 0 : true"
        @endif
        class="fi-fo-checkbox-list-options -space-y-px rounded-md bg-white dark:bg-gray-900"
    >
        @foreach ($options as $value => $label)
            @php
                $id = $name . '-' . $value;
                $description = $descriptions[$value] ?? null;
                $extra = $extras[$value] ?? null;
                $isChecked = in_array($value, $selectedArray, true);
            @endphp

            <label
                for="{{ $id }}"
                data-checkbox-option
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
                                name="{{ $name }}[]"
                                type="checkbox"
                                value="{{ $value }}"
                                @checked($isChecked)
                                @if ($bulkToggleable)
                                    x-on:change="checkIfAllChecked()"
                                @endif
                                {{ $wireAttrs }}
                                style="{{ $colors }}"
                                class="fi-checkbox-input shrink-0 checked:bg-custom-500 checked:border-custom-500 hover:checked:bg-custom-600 hover:checked:border-custom-600 focus:border-custom-500 focus:ring-custom-500"
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
                        name="{{ $name }}[]"
                        type="checkbox"
                        value="{{ $value }}"
                        @checked($isChecked)
                        @if ($bulkToggleable)
                            x-on:change="checkIfAllChecked()"
                        @endif
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
