<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasExtras;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasHiddenInputs;
use Filament\Support\Concerns\HasColor;

final class CheckboxCards extends \Filament\Forms\Components\CheckboxList
{
    use HasColor;
    use HasExtras;
    use HasHiddenInputs;

    protected string $view = 'filament-advanced-choice::checkbox-cards';

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary');
    }
}
