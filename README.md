# Filament Advanced Choice

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithdennis/filament-advanced-choice.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-advanced-choice)
[![Total Downloads](https://img.shields.io/packagist/dt/codewithdennis/filament-advanced-choice.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-advanced-choice)
[![License](https://img.shields.io/packagist/l/codewithdennis/filament-advanced-choice.svg?style=flat-square)](https://github.com/codewithdennis/filament-advanced-choice/blob/main/LICENSE)

This package ships **eight** form field classes for **FilamentPHP**: four behave like a **`Radio`** (one value), four like a **`CheckboxList`** (many values). Under the hood they extend FilamentPHP’s own field types, but each one uses its own **Blade** view so the UI is easier to read and tap.

![Filament Advanced Choice preview](art/thumbnail.png)

## Features

- **Eight field classes** — `RadioList`, `RadioCards`, `RadioStackedCards`, `RadioTable`, `CheckboxList`, `CheckboxCards`, `CheckboxStackedCards`, `CheckboxTable`. Each maps to a Blade template in this package.
- **Same API you already use** — `options()`, `descriptions()`, validation, `disableOptionWhen()`, relationships, and on checkbox types `bulkToggleable()` and the rest of FilamentPHP’s `CheckboxList` API.
- **`extras()`** — Extra text next to an option (price, badge, short note). Pass an array, or read it from a **backed enum** (see [Enum support](#enum-support)).
- **`searchable()`** — Works on every variant; search prompt and “no results” text behave like FilamentPHP’s searchable checkbox list.
- **Grid on card layouts** — `RadioCards`, `RadioStackedCards`, `CheckboxCards`, and `CheckboxStackedCards` support `columns()` and `gridDirection()` through FilamentPHP’s schema helpers.
- **Colors** — Field-level `color()` (default `primary`). Optional: if an enum case exposes `getColor()`, some layouts use it for that row/card (FilamentPHP’s usual enum pattern).
- **`hiddenInputs()` / `visibleInputs()`** — For card-style fields, hide the native radio/checkbox control and show a custom icon instead (`hiddenInputIcon()`).

## Compatibility

Use this table to match **this package’s version** with **FilamentPHP** and **PHP** in your app:

| Package | FilamentPHP (`filament/forms`) | PHP |
|--------|-------------------------|-----|
| **1.x** | `^4.0` / `^5.0` | `^8.1` |

## Requirements

Your project should already have:

1. **Laravel** with **FilamentPHP** forms **v4 or v5** — the same app where you build FilamentPHP panels, resources, or standalone forms.
2. **PHP 8.1 or newer** — required by this package’s code and dependencies.
3. **Tailwind “content” path** — only if you compile a **custom FilamentPHP panel theme**. Tailwind must scan this package’s Blade views, or some utility classes will never exist in your built CSS. How to do that is in [Theme / Tailwind](#theme--tailwind) below.

## Installation

Run **Composer** against **Packagist** (no private repository):

```bash
composer require codewithdennis/filament-advanced-choice
```

Laravel **auto-discovers** the **service provider**. There is **no** `config` file to publish.

## Theme / Tailwind

These fields use **Tailwind CSS** classes that live in this package’s **Blade** files.

When you use a **custom FilamentPHP panel theme**, Tailwind only emits CSS for files it is told to scan. If this package is not in that list, the UI can look broken in production because classes such as `has-checked:outline-custom-600` were never generated.

Add the following to your theme entry CSS (often `theme.css`). Change the number of `../` segments so the path resolves from **your** CSS file to **`vendor/codewithdennis/filament-advanced-choice/resources/**/*.blade.php`** inside **your** project:

```css
@source '../../../../vendor/codewithdennis/filament-advanced-choice/resources/**/*.blade.php';
```

## Quick start

Minimal **`RadioCards`** example: labels, **`descriptions()`** under each label, and **`extras()`** for a short side line (for example a price):

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

Every component class sits under **`CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components`**. Typical **`use`** imports:

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

Below, each **Component** section shows a screenshot and copy-paste **PHP**. Long examples use full `options` / `descriptions` / `extras`; shorter ones use a **backed enum** so the snippet stays small.

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

FilamentPHP already implements these behaviors on **`Radio`** / **`CheckboxList`**; our field classes inherit them.

**Search** (works on every component here):

```php
CheckboxList::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->searchable()
    ->searchPrompt('Search delivery types...')
    ->noSearchResultsMessage('No delivery types found.');
```

**Bulk select / deselect** (checkbox-style components only):

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

You can pass a **backed enum** class name to `options()` instead of an array.

Then wire up three small interfaces:

- `Filament\Support\Contracts\HasLabel` — text for the main line.
- `Filament\Support\Contracts\HasDescription` — text under the label.
- `CodeWithDennis\FilamentAdvancedChoice\Filament\Interfaces\HasExtra` — text for the **`extras()`** column (price, badge, etc.).

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

Optional: if a case implements **`getColor()`** (FilamentPHP’s normal enum pattern), some layouts use that color for that option only.

You can still call **`extras([...])`** with an array keyed by the enum **value**. If you do not, extras are read from each case’s **`getExtra()`** method.

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

`visibleInputs()` does the opposite of **`hiddenInputs()`** (show the native control again).

## Changelog

See [CHANGELOG.md](CHANGELOG.md) and [GitHub Releases](https://github.com/codewithdennis/filament-advanced-choice/releases).

## Contributing

Pull requests are welcome. For large changes, open a **GitHub issue** first so we can align on the design. Before you open a PR, run **`composer analyse`** and **`composer format`** so checks stay green.

## Security

If you believe you found a **security vulnerability**, follow [.github/SECURITY.md](.github/SECURITY.md). Do **not** post exploit details in a public issue.

## License

Licensed under the **MIT License**. Full text: [LICENSE](LICENSE).
