@php
    $colorMap = [
        'primary' => ['50' => '#eef2ff', '100' => '#e0e7ff', '400' => '#818cf8', '500' => '#6366f1', '600' => '#4f46e5', '700' => '#4338ca', '800' => '#3730a3'],
        'danger' => ['50' => '#fef2f2', '100' => '#fee2e2', '400' => '#f87171', '500' => '#ef4444', '600' => '#dc2626', '700' => '#b91c1c', '800' => '#991b1b'],
        'warning' => ['50' => '#fffbeb', '100' => '#fef3c7', '400' => '#fbbf24', '500' => '#f59e0b', '600' => '#d97706', '700' => '#b45309', '800' => '#92400e'],
        'success' => ['50' => '#f0fdf4', '100' => '#dcfce7', '400' => '#4ade80', '500' => '#22c55e', '600' => '#16a34a', '700' => '#15803d', '800' => '#166534'],
        'info' => ['50' => '#eff6ff', '100' => '#dbeafe', '400' => '#60a5fa', '500' => '#3b82f6', '600' => '#2563eb', '700' => '#1d4ed8', '800' => '#1e40af'],
    ];

    $shades = $colorMap[$color] ?? $colorMap['primary'];
    $colors = collect($shades)
        ->map(fn ($hex, $shade) => "--c-{$shade}:{$hex}")
        ->implode(';');

    $gridStyle = sprintf(
        'display: grid; grid-template-columns: repeat(%d, minmax(0, 1fr)); gap: 1rem;',
        max(1, $columns)
    );

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
            $el.querySelectorAll('.fi-fo-checkbox-list-option-ctn').forEach(el => {
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
        <div class="fi-fo-checkbox-list-search-input-wrp mb-4">
            <input
                placeholder="{{ $searchPrompt }}"
                type="search"
                x-model="search"
                class="fi-input w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-sm shadow-sm"
            />
        </div>
    @endif

    <div
        @if ($searchable)
            x-show="search ? visibleOptionsCount > 0 : true"
        @endif
        class="fi-fo-checkbox-list-options gap-4"
        style="{{ $gridStyle }}"
    >
        @forelse ($options as $value => $label)
            @php
                $id = $name . '-' . $value;
                $description = $descriptions[$value] ?? null;
                $extra = $extras[$value] ?? null;
                $isChecked = in_array($value, $selectedArray, true);
            @endphp

            <div class="fi-fo-checkbox-list-option-ctn">
                <label
                    for="{{ $id }}"
                    @class([
                        'fi-fo-checkbox-list-option group relative block rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-6 py-4 has-checked:outline-2 has-checked:-outline-offset-1 has-checked:outline-custom-600 dark:has-checked:outline-custom-500 has-focus-visible:outline-3 has-focus-visible:-outline-offset-1 has-disabled:opacity-60 has-disabled:cursor-not-allowed sm:flex sm:justify-between',
                        'not-has-disabled:cursor-pointer' => $cursorPointer,
                    ])
                    style="{{ $colors }}"
                >
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
                            <span class="flex flex-col text-sm">
                                <span class="option-label font-medium text-gray-900 dark:text-gray-100">
                                    {{ $label }}
                                </span>
                                @if ($description)
                                    <span class="option-description text-gray-500 dark:text-gray-400">
                                        {{ $description }}
                                    </span>
                                @endif
                            </span>
                        </div>
                        @if ($extra)
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $extra }}</span>
                        @endif
                    </div>

                    @if ($hiddenInputs)
                        <x-filament::icon
                            :icon="$hiddenInputIcon"
                            class="invisible size-5 text-custom-600 dark:text-custom-500 group-has-checked:visible absolute top-2 right-2"
                        />
                    @endif
                </label>
            </div>
        @empty
            <div></div>
        @endforelse
    </div>

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
