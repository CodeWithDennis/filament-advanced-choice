<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasCursorPointer;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasExtras;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasHiddenInputs;
use Filament\Support\Concerns\HasColor;
use Filament\Support\Concerns\HasIconPosition;
use Filament\Forms\Components\Concerns\HasIcons;
use Filament\Support\Concerns\HasIconSize;

class CheckboxList extends \Filament\Forms\Components\CheckboxList
{
    use HasColor;
    use HasCursorPointer;
    use HasExtras;
    use HasHiddenInputs;
    use HasIconPosition;
    use HasIcons;
    use HasIconSize;

    protected string $view = 'filament-advanced-choice::checkbox-list';

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary');
    }
}
