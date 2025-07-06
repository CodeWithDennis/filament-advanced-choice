<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentAdvancedChoiceServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-advanced-choice';

    public static string $viewNamespace = 'filament-advanced-choice';

    public function configurePackage(Package $package): void
    {
        $package->name(self::$name);

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(self::$viewNamespace);
        }
    }
}
