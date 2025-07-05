<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasHiddenInputs;
use Filament\Forms\Components\Radio;
use Filament\Support\Concerns\HasColor;

final class RadioTable extends Radio
{
    use HasColor;
    use HasHiddenInputs;

    protected string $view = 'filament-advanced-choice::radio-table';

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary');
    }
}
