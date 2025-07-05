<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasExtras;

final class CheckboxList extends \Filament\Forms\Components\CheckboxList
{
    use HasExtras;

    protected string $view = 'filament-advanced-choice::checkbox-list';
}
