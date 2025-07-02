<?php

namespace CodeWithDennis\FilamentAdvancedChoice\Commands;

use Illuminate\Console\Command;

class FilamentAdvancedChoiceCommand extends Command
{
    public $signature = 'filament-advanced-choice';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
