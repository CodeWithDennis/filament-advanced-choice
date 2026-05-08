<?php

declare(strict_types=1);

namespace CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use UnitEnum;

trait HasImages
{
    /**
     * @var (
     *     array<int|string, string|null>|
     *     Arrayable<int|string, string|null>|
     *     string|
     *     (Closure(): array<int|string, string|null>|Arrayable<int|string, string|null>|string|null)|
     *     null
     * )
     */
    protected array | Arrayable | string | Closure | null $images = null;

    /**
     * @param  array<int|string, string|null>|Arrayable<int|string, string|null>|string|Closure|null  $images
     */
    public function images(array | Arrayable | string | Closure | null $images): static
    {
        $this->images = $images;

        if (is_string($images) && enum_exists($images)) {
            $this->enum($images);
        }

        return $this;
    }

    /**
     * @return array<int|string, string|null>
     */
    public function getImages(): array
    {
        $images = $this->evaluate($this->images) ?? $this->getEnum() ?? [];

        if (
            is_string($images) &&
            enum_exists($enum = $images)
        ) {
            return array_reduce($enum::cases(), function (array $carry, UnitEnum $case): array {
                $key = $case instanceof \BackedEnum ? $case->value : $case->name;

                if (method_exists($case, 'getImage')) {
                    $carry[$key] = $case->getImage();
                } else {
                    $carry[$key] = null;
                }

                return $carry;
            }, []);
        }

        if ($images instanceof Arrayable) {
            $images = $images->toArray();
        }

        return is_array($images) ? $images : [];
    }
}
