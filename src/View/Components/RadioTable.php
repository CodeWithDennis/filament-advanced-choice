<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\View\Components;

use Illuminate\View\Component;

class RadioTable extends Component
{
    public function __construct(
        public string $name,
        public string|array $options = [],
        public array $descriptions = [],
        public array $extras = [],
        public ?string $color = 'primary',
        public bool $hiddenInputs = false,
        public string $hiddenInputIcon = 'heroicon-s-check-circle',
        public bool $cursorPointer = true,
        public bool $searchable = false,
        public string $searchPrompt = 'Search...',
        public string $noSearchResultsMessage = 'No results found.',
        public ?string $selected = null,
    ) {
        $this->resolveOptions();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('filament-advanced-choice::components.radio-table');
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
