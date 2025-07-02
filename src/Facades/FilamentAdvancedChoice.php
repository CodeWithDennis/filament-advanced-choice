<?php

namespace CodeWithDennis\FilamentAdvancedChoice\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CodeWithDennis\FilamentAdvancedChoice\FilamentAdvancedChoice
 */
class FilamentAdvancedChoice extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \CodeWithDennis\FilamentAdvancedChoice\FilamentAdvancedChoice::class;
    }
}
