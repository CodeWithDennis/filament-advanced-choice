<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\View\Components;

use Filament\Support\Facades\FilamentColor;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioStackedCard extends Component
{
    public function __construct(
        public string $name,
        public string | array $options = [],
        public array $descriptions = [],
        public array $extras = [],
        public string | array | null $color = 'primary',
        public int $columns = 1,
        public string $gridDirection = 'row',
        public bool $hiddenInputs = false,
        public string $hiddenInputIcon = 'heroicon-s-check-circle',
        public bool $cursorPointer = true,
        public bool $searchable = false,
        public ?string $searchPrompt = null,
        public ?string $noSearchResultsMessage = null,
        public ?string $selected = null,
    ) {
        $this->resolveOptions();
    }

    public function render(): View
    {
        return view('filament-advanced-choice::components.radio-stacked-card');
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
