<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\View\Components;

use Filament\Support\Facades\FilamentColor;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioList extends Component
{
    public function __construct(
        /** The HTML input name attribute. */
        public string $name,

        /** Array of ['value' => 'Label'] or fully qualified enum class name. */
        public string | array $options = [],

        /** Array of ['value' => 'description text']. */
        public array $descriptions = [],

        /** Array of ['value' => 'extra text for the right column']. */
        public array $extras = [],

        /** Color preset (string name, array of RGB shades, or null). */
        public string | array | null $color = 'primary',

        /** Hide the native radio input and make the whole option clickable. */
        public bool $hiddenInputs = false,

        /** Heroicon used as the selected indicator when hiddenInputs is enabled. */
        public string $hiddenInputIcon = 'heroicon-s-check-circle',

        /** Show cursor pointer on hover when the option is not disabled. */
        public bool $cursorPointer = true,

        /** Show an Alpine.js search field that filters options. */
        public bool $searchable = false,

        /** Placeholder text for the search input. Uses translation when null. */
        public ?string $searchPrompt = null,

        /** Message shown when the search yields no results. Uses translation when null. */
        public ?string $noSearchResultsMessage = null,

        /** The currently selected value (use with wire:model for reactivity). */
        public ?string $selected = null,
    ) {
        $this->resolveOptions();
    }

    public function render(): View
    {
        return view('filament-advanced-choice::components.radio-list');
    }

    /**
     * Resolve the color name to its Filament RGB shades array.
     * Returns null if the color cannot be resolved.
     *
     * @return array<int, int[]>|null
     */
    public function resolvedColor(): ?array
    {
        if (is_array($this->color)) {
            return $this->color;
        }

        try {
            $colors = FilamentColor::getColors();

            return $colors[$this->color] ?? null;
        } catch (\Throwable) {
            return null;
        }
    }

    public function getSearchPrompt(): string
    {
        return $this->searchPrompt
            ?? __('filament-advanced-choice::components.search_prompt');
    }

    public function getNoSearchResultsMessage(): string
    {
        return $this->noSearchResultsMessage
            ?? __('filament-advanced-choice::components.no_search_results_message');
    }

    private function resolveOptions(): void
    {
        if (is_array($this->options)) {
            return;
        }

        if (! is_string($this->options) || ! enum_exists($this->options)) {
            $this->options = [];

            return;
        }

        $this->resolveFromEnum($this->options);
    }

    private function resolveFromEnum(string $enumClass): void
    {
        $this->options = [];
        $this->descriptions = array_is_list($this->descriptions) && empty($this->descriptions) ? [] : $this->descriptions;
        $this->extras = array_is_list($this->extras) && empty($this->extras) ? [] : $this->extras;

        foreach ($enumClass::cases() as $case) {
            $key = $case instanceof \BackedEnum ? $case->value : $case->name;

            $this->options[$key] = method_exists($case, 'getLabel')
                ? $case->getLabel()
                : $case->name;

            if (method_exists($case, 'getDescription')) {
                $this->descriptions[$key] = $case->getDescription();
            }

            if (method_exists($case, 'getExtra')) {
                $this->extras[$key] = $case->getExtra();
            }
        }
    }
}
