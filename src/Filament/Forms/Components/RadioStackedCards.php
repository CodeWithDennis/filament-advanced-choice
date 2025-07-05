<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasExtras;
use Filament\Forms\Components\Radio;

final class RadioStackedCards extends Radio
{
    use HasExtras;

    protected string $view = 'filament-advanced-choice::radio-stacked-cards';
} 