<?php

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns;

use Closure;

trait HasExtras
{
    public Closure | array $extras = [];

    public function extras(Closure | array $extras): static
    {
        $this->extras = $extras;

        return $this;
    }

    public function getExtras(): array
    {
        return $this->evaluate($this->extras);
    }
}
