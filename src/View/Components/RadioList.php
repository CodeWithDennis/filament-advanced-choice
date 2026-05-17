<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\View\Components;

use Illuminate\View\Component;

class RadioList extends Component
{
    public function __construct(
        /** The HTML input name attribute. */
        public string $name,

        /** Array of ['value' => 'Label'] or fully qualified enum class name. */
        public string|array $options = [],

        /** Array of ['value' => 'description text']. */
        public array $descriptions = [],

        /** Array of ['value' => 'extra text for the right column']. */
        public array $extras = [],

        /** Color preset (primary, danger, warning, success, info). */
        public ?string $color = 'primary',

        /** Hide the native radio input and make the whole option clickable. */
        public bool $hiddenInputs = false,

        /** Heroicon used as the selected indicator when hiddenInputs is enabled. */
        public string $hiddenInputIcon = 'heroicon-s-check-circle',

        /** Show cursor pointer on hover when the option is not disabled. */
        public bool $cursorPointer = true,

        /** Show an Alpine.js search field that filters options. */
        public bool $searchable = false,

        /** Placeholder text for the search input. */
        public string $searchPrompt = 'Search...',

        /** Message shown when the search yields no results. */
        public string $noSearchResultsMessage = 'No results found.',

        /** The currently selected value (use with wire:model for reactivity). */
        public ?string $selected = null,
    ) {
        $this->resolveOptions();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('filament-advanced-choice::components.radio-list');
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
