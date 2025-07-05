<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasExtras;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasHiddenInputs;
use Filament\Forms\Components\Radio;
use Filament\Schemas\Concerns\HasColumns;
use Filament\Support\Concerns\HasColor;

final class RadioStackedCards extends Radio
{
    use HasColor;
    use HasColumns;
    use HasExtras;
    use HasHiddenInputs;

    protected string $view = 'filament-advanced-choice::radio-stacked-cards';

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary');
    }
}
