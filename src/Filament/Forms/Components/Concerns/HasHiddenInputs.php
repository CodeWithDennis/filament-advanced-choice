<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns;

use Closure;

trait HasHiddenInputs
{
    protected bool|Closure $hiddenInputs = false;
    protected string|\BackedEnum|\Closure|null $hiddenInputIcon = null;

    public function hiddenInputs(bool|Closure $condition = true): static
    {
        $this->hiddenInputs = $condition;

        return $this;
    }

    public function visibleInputs(bool|Closure $condition = true): static
    {
        $this->hiddenInputs = !$condition;

        return $this;
    }

    public function getHiddenInputs(): bool
    {
        return $this->evaluate($this->hiddenInputs);
    }

    public function hiddenInputIcon(string|\BackedEnum|\Closure|null $icon): static
    {
        $this->hiddenInputIcon = $icon;

        return $this;
    }

    public function getHiddenInputIcon(): string|\BackedEnum|null
    {
        return $this->evaluate($this->hiddenInputIcon);
    }
}
