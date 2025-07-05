<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasExtras;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasHiddenInputs;
use Filament\Forms\Components\Radio;
use Filament\Support\Concerns\HasColor;

final class RadioCards extends Radio
{
    use HasColor;
    use HasExtras;
    use HasHiddenInputs;

    protected string $view = 'filament-advanced-choice::radio-cards';

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary');
    }
}
