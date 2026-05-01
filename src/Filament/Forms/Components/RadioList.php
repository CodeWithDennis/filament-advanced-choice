<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasCursorPointer;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasExtras;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasHiddenInputs;
use Filament\Forms\Components\Concerns\CanBeSearchable;
use Filament\Forms\Components\Radio;
use Filament\Support\Concerns\HasColor;

final class RadioList extends Radio
{
    use CanBeSearchable;
    use HasColor;
    use HasCursorPointer;
    use HasExtras;
    use HasHiddenInputs;

    protected string $view = 'filament-advanced-choice::radio-list';

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary');
    }
}
