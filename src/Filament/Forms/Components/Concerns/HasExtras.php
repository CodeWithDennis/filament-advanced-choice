<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use UnitEnum;

trait HasExtras
{
    /**
     * @var (
     *     array<int|string, string|list<string>|Htmlable|null>|
     *     Arrayable<int|string, string|list<string>|Htmlable|null>|
     *     string|
     *     (Closure(): array<int|string, string|list<string>|Htmlable|null>|Arrayable<int|string, string|list<string>|Htmlable|null>|string|null)|
     *     null
     * )
     */
    protected array | Arrayable | string | Closure | null $extras = null;

    /**
     * @param  array<int|string, string|list<string>|Htmlable|null>|Arrayable<int|string, string|list<string>|Htmlable|null>|string|Closure|null  $extras
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
     * @return array<int|string, string|list<string>|Htmlable|null>
     */
    public function getExtras(): array
    {
        $extras = $this->evaluate($this->extras) ?? $this->getEnum() ?? [];

        if (
            is_string($extras) &&
            enum_exists($enum = $extras)
        ) {
            return array_reduce($enum::cases(), function (array $carry, UnitEnum $case): array {
                $key = $case instanceof \BackedEnum ? $case->value : $case->name;

                if (method_exists($case, 'getExtra')) {
                    $carry[$key] = $case->getExtra();
                } else {
                    $carry[$key] = null;
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
