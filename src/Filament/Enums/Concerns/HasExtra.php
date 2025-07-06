<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Enums\Concerns;

use Illuminate\Contracts\Support\Htmlable;

interface HasExtra
{
    public function getLabel(): string | Htmlable | null;
}
