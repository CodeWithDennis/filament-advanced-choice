<?php

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns;

use Closure;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasExtras as ExtraInterface;
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
            if (is_a($enum, LabelInterface::class, allow_string: true)) {
                return array_reduce($enum::cases(), function (array $carry, ExtraInterface & UnitEnum $case): array {
                    $carry[$case->value ?? $case->name] = $case->getExtra() ?? null;

                    return $carry;
                }, []);
            }

            return array_reduce($enum::cases(), function (array $carry, UnitEnum $case): array {
                $carry[$case->value ?? $case->name] = $case->getExtra();

                return $carry;
            }, []);
        }

        if ($extras instanceof Arrayable) {
            $extras = $extras->toArray();
        }

        return $extras;
    }
}
