<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns;

use Closure;

trait HasCursorPointer
{
    protected bool | Closure $hasCursorPointer = true;

    public function cursorPointer(bool | Closure $condition = true): static
    {
        $this->hasCursorPointer = $condition;

        return $this;
    }

    public function defaultCursor(bool | Closure $condition = true): static
    {
        $this->hasCursorPointer = is_bool($condition)
            ? ! $condition
            : fn (): bool => ! $this->evaluate($condition);

        return $this;
    }

    public function hasCursorPointer(): bool
    {
        return (bool) $this->evaluate($this->hasCursorPointer);
    }
}
