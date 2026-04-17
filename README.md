# Filament Advanced Choice

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithdennis/filament-advanced-choice.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-advanced-choice)
[![Total Downloads](https://img.shields.io/packagist/dt/codewithdennis/filament-advanced-choice.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-advanced-choice)
[![License](https://img.shields.io/packagist/l/codewithdennis/filament-advanced-choice.svg?style=flat-square)](https://github.com/codewithdennis/filament-advanced-choice/blob/main/LICENSE)

**Filament Advanced Choice** adds eight opinionated form field variants—four for single choice (radio) and four for multiple choice (checkbox)—built on top of FilamentPHP’s native `Radio` and `CheckboxList` APIs. Each layout is styled for clarity, supports rich option metadata (descriptions, extras, optional per-option colors), and stays familiar to anyone who already uses FilamentPHP forms.

![Filament Advanced Choice preview](art/thumbnail.png)

## Features

- **Eight drop-in components** — `RadioList`, `RadioCards`, `RadioStackedCards`, `RadioTable`, `CheckboxList`, `CheckboxCards`, `CheckboxStackedCards`, `CheckboxTable`, each with a dedicated Blade layout tuned for readability and touch targets.
- **Everything you expect from FilamentPHP** — `options()`, `descriptions()`, validation, disabled states, `disableOptionWhen()`, relationships, and (for checkbox variants) `bulkToggleable()` and the rest of FilamentPHP’s `CheckboxList` behavior.
- **`extras()` for secondary text** — Show pricing, badges, meta, or any short string beside each option; map keys to values or drive everything from a backed enum (see below).
- **Searchable options** — `searchable()` on every variant, with the same search prompts / empty states as FilamentPHP’s searchable checkbox list.
- **Grid-aware card layouts** — `RadioCards`, `RadioStackedCards`, `CheckboxCards`, and `CheckboxStackedCards` support `columns()` and `gridDirection()` via FilamentPHP’s schema utilities.
- **FilamentPHP color system** — Global `color()` on the field (default `primary`); optional **per-enum-case** accent when the case implements `getColor()` (same pattern as core FilamentPHP enum colors).
- **Polished selection chrome** — `hiddenInputs()` / `visibleInputs()` and `hiddenInputIcon()` for card-style fields when you want icon-only or minimal radio/checkbox visuals.

## Compatibility

| Package | FilamentPHP (`filament/forms`) | PHP |
|--------|-------------------------|-----|
| **1.x** | `^4.0` / `^5.0` | `^8.1` |

## Requirements

- Laravel application with FilamentPHP forms **v4 or v5**
- **PHP 8.1+**
- For compiled panel themes, Tailwind must see this package’s views (see [Theme / Tailwind](#theme--tailwind))

## Installation

Install via Composer (Packagist):

```bash
composer require codewithdennis/filament-advanced-choice
```

Laravel will auto-discover the service provider. There is no config file to publish.

## Theme / Tailwind

Layouts use FilamentPHP’s design tokens and utility classes. If you use a **custom FilamentPHP theme**, add the package views to Tailwind’s content sources so classes are not purged—for example in your theme CSS (adjust `../` segments to match your file layout):

```css
@source '../../../../vendor/codewithdennis/filament-advanced-choice/resources/**/*.blade.php';
```

## Quick start

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioCards;

RadioCards::make('plan')
    ->options([
        'hobby' => 'Hobby',
        'pro' => 'Pro',
    ])
    ->descriptions([
        'hobby' => 'For side projects',
        'pro' => 'For teams',
    ])
    ->extras([
        'hobby' => '$9/mo',
        'pro' => '$29/mo',
    ]);
```

## Components at a glance

| Component | Base FilamentPHP field | Layout |
|-----------|---------------------|--------|
| `RadioList` | `Radio` | Vertical list |
| `RadioCards` | `Radio` | Responsive card grid (`columns()`, `gridDirection()`) |
| `RadioStackedCards` | `Radio` | Full-width stacked cards |
| `RadioTable` | `Radio` | Table-style rows |
| `CheckboxList` | `CheckboxList` | Vertical list |
| `CheckboxCards` | `CheckboxList` | Card grid |
| `CheckboxStackedCards` | `CheckboxList` | Stacked cards |
| `CheckboxTable` | `CheckboxList` | Table-style rows |

All classes live under `CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components`:

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxCards;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxList;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxStackedCards;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxTable;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioCards;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioList;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioStackedCards;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioTable;
```

The sections below mirror real usage: full `options` / `descriptions` / `extras` where it helps, and enums where the layout is easier to show in fewer lines.

## Components

### CheckboxList

Vertical list layout with descriptions for multiple selections.

![CheckboxList](art/basic_checkbox_list.png)

```php
CheckboxList::make('delivery_type')
    ->searchable()
    ->bulkToggleable()
    ->options([
        'standard' => 'Standard Delivery',
        'express' => 'Express Delivery',
        'overnight' => 'Overnight Delivery',
        'same_day' => 'Same Day Delivery',
        'economy' => 'Economy Delivery',
        'premium' => 'Premium Delivery',
        'international' => 'International Delivery',
        'local' => 'Local Delivery',
    ])
    ->descriptions([
        'standard' => 'Delivery within 5-7 business days',
        'express' => 'Delivery within 2-3 business days',
        'overnight' => 'Next day delivery available',
        'same_day' => 'Delivery on the same day',
        'economy' => 'Budget-friendly delivery option',
        'premium' => 'Premium service with tracking',
        'international' => 'Worldwide shipping available',
        'local' => 'Same city delivery service',
    ])
    ->extras([
        'standard' => '$5.00 flat rate',
        'express' => '$10.00 flat rate',
        'overnight' => '$20.00 flat rate',
        'same_day' => '$25.00 flat rate',
        'economy' => '$3.00 flat rate',
        'premium' => '$15.00 flat rate',
        'international' => '$50.00 flat rate',
        'local' => '$8.00 flat rate',
    ]);
```

### CheckboxCards

Card-based layout with descriptions and extras support for multiple selections.

![CheckboxCards](art/basic_checkbox_cards.png)

```php
CheckboxCards::make('delivery_type')
    ->searchable()
    ->bulkToggleable()
    ->options([
        'standard' => 'Standard Delivery',
        'express' => 'Express Delivery',
        'overnight' => 'Overnight Delivery',
        'same_day' => 'Same Day Delivery',
        'economy' => 'Economy Delivery',
        'premium' => 'Premium Delivery',
        'international' => 'International Delivery',
        'local' => 'Local Delivery',
    ])
    ->descriptions([
        'standard' => 'Delivery within 5-7 business days',
        'express' => 'Delivery within 2-3 business days',
        'overnight' => 'Next day delivery available',
        'same_day' => 'Delivery on the same day',
        'economy' => 'Budget-friendly delivery option',
        'premium' => 'Premium service with tracking',
        'international' => 'Worldwide shipping available',
        'local' => 'Same city delivery service',
    ])
    ->extras([
        'standard' => '$5.00 flat rate',
        'express' => '$10.00 flat rate',
        'overnight' => '$20.00 flat rate',
        'same_day' => '$25.00 flat rate',
        'economy' => '$3.00 flat rate',
        'premium' => '$15.00 flat rate',
        'international' => '$50.00 flat rate',
        'local' => '$8.00 flat rate',
    ]);
```

### CheckboxStackedCards

Stacked card layout with descriptions and extras support for multiple selections.

![CheckboxStackedCards](art/basic_checkbox_stacked_cards.png)

```php
CheckboxStackedCards::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->searchable()
    ->bulkToggleable();
```

### CheckboxTable

Responsive table layout with descriptions for multiple selections.

![CheckboxTable](art/basic_checkbox_table.png)

```php
CheckboxTable::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->searchable()
    ->bulkToggleable();
```

### RadioList

Vertical list layout with descriptions.

![RadioList](art/basic_radio_list.png)

```php
RadioList::make('delivery_type')
    ->options(DeliveryTypeEnum::class);
```

### RadioTable

Responsive table layout with descriptions.

![RadioTable](art/basic_radio_table.png)

```php
RadioTable::make('delivery_type')
    ->options(DeliveryTypeEnum::class);
```

### RadioCards

Card-based layout with descriptions and extras support.

![RadioCards](art/basic_radio_cards.png)

```php
RadioCards::make('delivery_type')
    ->options(DeliveryTypeEnum::class);
```

### RadioStackedCards

Stacked card layout with descriptions and extras support.

![RadioStackedCards](art/basic_radio_stacked_cards.png)

```php
RadioStackedCards::make('delivery_type')
    ->options(DeliveryTypeEnum::class);
```

## Search, bulk actions, and disabling options

**Search** (all components):

```php
CheckboxList::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->searchable()
    ->searchPrompt('Search delivery types...')
    ->noSearchResultsMessage('No delivery types found.');
```

**Bulk select / deselect** (checkbox components only):

```php
CheckboxList::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->bulkToggleable();
```

**Disable individual options** (inherited from FilamentPHP):

```php
CheckboxList::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->disableOptionWhen(fn (string $value): bool => $value === 'premium');
```

## Enum support

You can pass a **backed enum** to `options()`. For labels and descriptions, implement `Filament\Support\Contracts\HasLabel` and `Filament\Support\Contracts\HasDescription`. For the extra column (pricing, badges, etc.), implement this package’s `CodeWithDennis\FilamentAdvancedChoice\Filament\Interfaces\HasExtra`.

<details>
<summary><strong>Full enum example</strong></summary>

```php
<?php

declare(strict_types=1);

namespace App\Enums;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Interfaces\HasExtra;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum DeliveryTypeEnum: string implements HasDescription, HasExtra, HasLabel
{
    case Standard = 'standard';
    case Express = 'express';
    case Overnight = 'overnight';
    case SameDay = 'same_day';
    case Economy = 'economy';
    case Premium = 'premium';
    case International = 'international';
    case Local = 'local';

    public function getLabel(): string
    {
        return match ($this) {
            self::Standard => __('Standard Delivery'),
            self::Express => __('Express Delivery'),
            self::Overnight => __('Overnight Delivery'),
            self::SameDay => __('Same Day Delivery'),
            self::Economy => __('Economy Delivery'),
            self::Premium => __('Premium Delivery'),
            self::International => __('International Delivery'),
            self::Local => __('Local Delivery'),
        };
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::Standard => __('Delivery within 5-7 business days'),
            self::Express => __('Delivery within 2-3 business days'),
            self::Overnight => __('Next day delivery available'),
            self::SameDay => __('Delivery on the same day'),
            self::Economy => __('Budget-friendly delivery option'),
            self::Premium => __('Premium service with tracking'),
            self::International => __('Worldwide shipping available'),
            self::Local => __('Same city delivery service'),
        };
    }

    public function getExtra(): ?string
    {
        return match ($this) {
            self::Standard => __('$5.00 flat rate'),
            self::Express => __('$10.00 flat rate'),
            self::Overnight => __('$20.00 flat rate'),
            self::SameDay => __('$25.00 flat rate'),
            self::Economy => __('$3.00 flat rate'),
            self::Premium => __('$15.00 flat rate'),
            self::International => __('$50.00 flat rate'),
            self::Local => __('$8.00 flat rate'),
        };
    }
}
```

</details>

<details>
<summary><strong>Example schema snippet</strong></summary>

```php
use App\Enums\DeliveryTypeEnum;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioStackedCards;
use Filament\Schemas\Schema;

public static function configure(Schema $schema): Schema
{
    return $schema
        ->columns(1)
        ->components([
            RadioStackedCards::make('delivery_type')
                ->options(DeliveryTypeEnum::class),
        ]);
}
```

</details>

If the enum case defines **`getColor()`** (same as core FilamentPHP enum patterns), card/table/list views can pick up **per-option** color accents.

When you pass the enum class string to `options()`, you can still use `extras()` with an array keyed by enum value; passing only the enum defers extras to `getExtra()` on each case.

## Customization

### Field color

```php
use Filament\Support\Colors\Color;

CheckboxCards::make('plan')
    ->options(Plan::class)
    ->color(Color::Rose);
```

### Hide native inputs on cards

```php
CheckboxCards::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->hiddenInputs();
```

### Hidden input icon

By default, the hidden input icon for card components is `heroicon-s-check-circle`. You can override it:

```php
RadioCards::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->hiddenInputIcon('heroicon-o-chevron-double-down')
    ->hiddenInputs();
```

Use `visibleInputs()` for the inverse of `hiddenInputs()`.

## Changelog

See [CHANGELOG.md](CHANGELOG.md) and [GitHub Releases](https://github.com/codewithdennis/filament-advanced-choice/releases).

## Contributing

Contributions are welcome. Please open an issue first for larger changes, and ensure `composer analyse` and `composer format` pass before sending a pull request.

## Security

Please review [SECURITY.md](.github/SECURITY.md) for how to report security issues responsibly.

## License

Open source under the MIT License. See the [LICENSE](LICENSE) file in this repository.
