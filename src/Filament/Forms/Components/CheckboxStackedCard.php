<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasCursorPointer;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasExtras;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasHiddenInputs;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Concerns\HasGridDirection;
use Filament\Schemas\Concerns\HasColumns;
use Filament\Support\Concerns\HasColor;
use Filament\Support\Enums\GridDirection;

class CheckboxStackedCard extends CheckboxList
{
    use HasColor;
    use HasColumns;
    use HasCursorPointer;
    use HasExtras;
    use HasGridDirection;
    use HasHiddenInputs;

    protected string $view = 'filament-advanced-choice::checkbox-stacked-cards';

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary')
            ->columns(1)
            ->gridDirection(GridDirection::Row);
    }
}
