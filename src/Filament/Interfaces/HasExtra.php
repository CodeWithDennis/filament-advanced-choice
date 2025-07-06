<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Interfaces;

use Illuminate\Contracts\Support\Htmlable;

interface HasExtra
{
    public function getExtra(): string | Htmlable | null;
}
