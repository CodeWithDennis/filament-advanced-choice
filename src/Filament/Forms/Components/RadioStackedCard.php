<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasCursorPointer;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasExtras;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasHiddenInputs;
use Filament\Forms\Components\Concerns\CanBeSearchable;
use Filament\Forms\Components\Concerns\HasGridDirection;
use Filament\Forms\Components\Radio;
use Filament\Schemas\Concerns\HasColumns;
use Filament\Support\Concerns\HasColor;
use Filament\Support\Enums\GridDirection;
use Filament\Support\Concerns\HasIconPosition;
use Filament\Forms\Components\Concerns\HasIcons;
use Filament\Support\Concerns\HasIconSize;

class RadioStackedCard extends Radio
{
    use CanBeSearchable;
    use HasColor;
    use HasColumns;
    use HasCursorPointer;
    use HasExtras;
    use HasGridDirection;
    use HasHiddenInputs;
    use HasIconPosition;
    use HasIcons;
    use HasIconSize;

    protected string $view = 'filament-advanced-choice::radio-stacked-cards';

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary')
            ->gridDirection(GridDirection::Row);
    }
}
