<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasExtras;
use Filament\Forms\Components\Radio;
use Filament\Support\Concerns\HasColor;

final class RadioList extends Radio
{
    use HasColor;
    use HasExtras;

    protected string $view = 'filament-advanced-choice::radio-list';

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary');
    }
}
