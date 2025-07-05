<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasExtras;
use Filament\Support\Concerns\HasColor;

final class CheckboxStackedCards extends \Filament\Forms\Components\CheckboxList
{
    use HasColor;
    use HasExtras;

    protected string $view = 'filament-advanced-choice::checkbox-stacked-cards';

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary');
    }
}
