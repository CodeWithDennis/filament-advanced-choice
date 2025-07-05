<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use Filament\Forms\Components\Radio;
use Filament\Support\Concerns\HasColor;

final class RadioTable extends Radio
{
    use HasColor;

    protected string $view = 'filament-advanced-choice::radio-table';

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary');
    }
}
