<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasCursorPointer;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasExtras;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasHiddenInputs;
use Filament\Forms\Components\CheckboxList;
use Filament\Support\Concerns\HasColor;

class CheckboxTable extends CheckboxList
{
    use HasColor;
    use HasCursorPointer;
    use HasExtras;
    use HasHiddenInputs;

    protected string $view = 'filament-advanced-choice::checkbox-table';

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary');
    }
}
