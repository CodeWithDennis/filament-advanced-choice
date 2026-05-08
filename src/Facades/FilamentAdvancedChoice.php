<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CodeWithDennis\FilamentAdvancedChoice\FilamentAdvancedChoice
 */
class FilamentAdvancedChoice extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \CodeWithDennis\FilamentAdvancedChoice\FilamentAdvancedChoice::class;
    }
}
