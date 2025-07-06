<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use UnitEnum;

trait HasExtras
{
    protected array | Arrayable | string | Closure | null $extras = null;

    /**
     * @param  array<string | array<string>> | Arrayable | string | Closure | null  $extras
     */
    public function extras(array | Arrayable | string | Closure | null $extras): static
    {
        $this->extras = $extras;

        if (is_string($extras) && enum_exists($extras)) {
            $this->enum($extras);
        }

        return $this;
    }

    /**
     * @return array<string | array<string>>
     */
    public function getExtras(): array
    {
        $extras = $this->evaluate($this->extras) ?? $this->getEnum() ?? [];

        if (
            is_string($extras) &&
            enum_exists($enum = $extras)
        ) {
            return array_reduce($enum::cases(), function (array $carry, UnitEnum $case): array {
                if (method_exists($case, 'getExtra')) {
                    $carry[$case->value ?? $case->name] = $case->getExtra();
                } else {
                    $carry[$case->value ?? $case->name] = null;
                }

                return $carry;
            }, []);
        }

        if ($extras instanceof Arrayable) {
            $extras = $extras->toArray();
        }

        return $extras;
    }
}
