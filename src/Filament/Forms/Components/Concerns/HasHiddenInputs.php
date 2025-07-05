<?php

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns;

use Closure;

trait HasHiddenInputs
{
    protected bool | Closure $hiddenInputs = false;

    public function hiddenInputs(bool | Closure $condition = true): static
    {
        $this->hiddenInputs = $condition;

        return $this;
    }

    public function visibleInputs(bool | Closure $condition = true): static
    {
        $this->hiddenInputs = ! $condition;

        return $this;
    }

    public function getHiddenInputs(): bool
    {
        return $this->evaluate($this->hiddenInputs);
    }
}
