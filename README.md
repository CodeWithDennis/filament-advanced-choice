# Filament Advanced Choice

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithdennis/filament-advanced-choice.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-advanced-choice)
[![Total Downloads](https://img.shields.io/packagist/dt/codewithdennis/filament-advanced-choice.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-advanced-choice)

This package introduces eight new form fields for FilamentPHP. Four of them are based on `Radio`, and four are based on `CheckboxList`.

![Filament Advanced Choice preview](art/thumbnail.png)

## Requirements

- Filament 4/5

## Installation

**1.** Install with Composer:

```bash
composer require codewithdennis/filament-advanced-choice
```

**2.** To make sure styling works, add this to your custom FilamentPHP theme:

```css
@source '../../../../vendor/codewithdennis/filament-advanced-choice/resources/**/*.blade.php';
```

**3.** Run `npm run build` or `npm run dev` so the theme rebuilds.

## Components

Prefer the singular field classes (`RadioCard`, `RadioStackedCard`, `CheckboxCard`, `CheckboxStackedCard`). The plural names (`RadioCards`, `RadioStackedCards`, `CheckboxCards`, `CheckboxStackedCards`) remain as deprecated aliases for backward compatibility.

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

### CheckboxCard

Card-based layout with descriptions and extras support for multiple selections.

![CheckboxCard](art/basic_checkbox_cards.png)

```php
CheckboxCard::make('delivery_type')
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

### CheckboxStackedCard

Stacked card layout with descriptions and extras support for multiple selections.

![CheckboxStackedCard](art/basic_checkbox_stacked_cards.png)

```php
CheckboxStackedCard::make('delivery_type')
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

### RadioCard

Card-based layout with descriptions and extras support.

Smallest useful example with `options()`, `descriptions()`, and `extras()`:

```php
RadioCard::make('plan')
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

Same layout with a backed enum:

![RadioCard](art/basic_radio_cards.png)

```php
RadioCard::make('delivery_type')
    ->options(DeliveryTypeEnum::class);
```

### RadioStackedCard

Stacked card layout with descriptions and extras support.

![RadioStackedCard](art/basic_radio_stacked_cards.png)

```php
RadioStackedCard::make('delivery_type')
    ->options(DeliveryTypeEnum::class);
```

## Search, bulk actions, and disabling options

These come from FilamentPHP’s `Radio` and `CheckboxList` APIs (inherited unchanged).

Search:

```php
CheckboxList::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->searchable()
    ->searchPrompt('Search delivery types...')
    ->noSearchResultsMessage('No delivery types found.');
```

Bulk select (checkbox-style fields only):

```php
CheckboxList::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->bulkToggleable();
```

Disable one option:

```php
CheckboxList::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->disableOptionWhen(fn (string $value): bool => $value === 'premium');
```

## Enum support

Pass a backed enum class name to `options()` instead of an array. Implement:

- `Filament\Support\Contracts\HasLabel` (main label)
- `Filament\Support\Contracts\HasDescription` (subtitle)
- `CodeWithDennis\FilamentAdvancedChoice\Filament\Interfaces\HasExtra` (`extras()` column)

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
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioStackedCard;
use Filament\Schemas\Schema;

public static function configure(Schema $schema): Schema
{
    return $schema
        ->columns(1)
        ->components([
            RadioStackedCard::make('delivery_type')
                ->options(DeliveryTypeEnum::class),
        ]);
}
```

</details>

If a case implements `getColor()`, some layouts tint that option (same idea as core FilamentPHP enums).

Either pass `extras([...])` keyed by the enum value, or rely on `getExtra()` on each case.

## Customization

### Field color

```php
use Filament\Support\Colors\Color;

CheckboxCard::make('plan')
    ->options(Plan::class)
    ->color(Color::Rose);
```

### Hide native inputs on cards

```php
CheckboxCard::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->hiddenInputs();
```

### Hidden input icon

By default, the hidden input icon for card components is `heroicon-s-check-circle`. You can override it:

```php
RadioCard::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->hiddenInputIcon('heroicon-o-chevron-double-down')
    ->hiddenInputs();
```

`visibleInputs()` reverses `hiddenInputs()` (shows the native control again).

## Blade Components

If you're working outside the Filament Form Builder — in a Livewire component, a Filament custom page, or plain Blade — use the standalone Blade components.

| Form field          | Blade component                              |
|---------------------|----------------------------------------------|
| RadioList           | `<x-advanced-choice::radio-list>`            |
| RadioCard           | `<x-advanced-choice::radio-card>`            |
| RadioStackedCard    | `<x-advanced-choice::radio-stacked-card>`    |
| RadioTable          | `<x-advanced-choice::radio-table>`           |
| CheckboxList        | `<x-advanced-choice::checkbox-list>`         |
| CheckboxCard        | `<x-advanced-choice::checkbox-card>`         |
| CheckboxStackedCard | `<x-advanced-choice::checkbox-stacked-card>` |
| CheckboxTable       | `<x-advanced-choice::checkbox-table>`        |

### Basic usage

**Radio components (single selection):**

```blade
<x-advanced-choice::radio-list
    name="delivery"
    :options="['standard' => 'Standard', 'express' => 'Express']"
    :descriptions="['standard' => '5-7 days', 'express' => '1-2 days']"
    :selected="$delivery"
    wire:model.live="delivery"
/>

<x-advanced-choice::radio-card
    name="plan"
    :options="['hobby' => 'Hobby', 'pro' => 'Pro']"
    :descriptions="['hobby' => 'For side projects', 'pro' => 'For teams']"
    :extras="['hobby' => '$9/mo', 'pro' => '$29/mo']"
    :columns="2"
    :selected="$plan"
    hidden-inputs
    wire:model.live="plan"
/>
```

**Checkbox components (multiple selection):**

```blade
<x-advanced-choice::checkbox-list
    name="permissions"
    :options="['create' => 'Create', 'read' => 'Read', 'update' => 'Update', 'delete' => 'Delete']"
    :selected="$selectedPermissions"
    :bulk-toggleable="true"
    :searchable="true"
    wire:model.live="selectedPermissions"
/>

> **Note:** `bulkToggleable` uses `$wire.set()` internally to update
> all selected values in a single Livewire request. It requires
> `wire:model` to be present on the component. Without `wire:model`,
> bulk toggle manipulates the DOM directly (plain Blade forms).

```blade
<x-advanced-choice::checkbox-card
    name="features"
    :options="['analytics' => 'Analytics', 'reports' => 'Reports', 'api' => 'API Access']"
    :selected="$features"
    :columns="3"
    hidden-inputs
    wire:model.live="features"
/>
```

### Using enum classes

```blade
<x-advanced-choice::radio-stacked-card
    name="delivery_type"
    :options="\App\Enums\DeliveryTypeEnum::class"
    :selected="$deliveryType"
    wire:model="deliveryType"
/>
```

Enums implementing `HasLabel`, `HasDescription`, and `HasExtra` are resolved automatically.

### Common props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | `string` | — | HTML input name attribute |
| `options` | `string\|array` | `[]` | Array or enum FQCN |
| `descriptions` | `array` | `[]` | Keyed descriptions |
| `extras` | `array` | `[]` | Keyed extra text |
| `color` | `string\|array\|null` | `primary` | Filament color name or RGB shades array |
| `hiddenInputs` | `bool` | `false` | Hide native input |
| `hiddenInputIcon` | `string` | `heroicon-s-check-circle` | Icon for hidden state |
| `cursorPointer` | `bool` | `true` | Show pointer cursor |
| `searchable` | `bool` | `false` | Show search field |
| `searchPrompt` | `string\|null` | `null` | Search placeholder (defaults to Filament translation) |
| `noSearchResultsMessage` | `string\|null` | `null` | Empty results message (defaults to package translation) |
| `selected` | `string\|array\|null` | `null` / `[]` | Selected value(s) |

**Radio-only:**

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `selected` | `string\|null` | `null` | Selected value |

**Checkbox-only:**

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `selected` | `array\|string\|null` | `[]` | Selected values |
| `bulkToggleable` | `bool` | `false` | Select all / deselect all |

**Grid layouts (Card / StackedCard):**

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `columns` | `int` | `3` / `1` | Number of grid columns |
| `gridDirection` | `string` | `row` | Grid direction |

### Translations

`searchPrompt` and `noSearchResultsMessage` default to the project locale automatically.
To override them for a specific instance, pass the prop explicitly:

```blade
<x-advanced-choice::checkbox-list
    name="features"
    :options="$options"
    search-prompt="Filter features..."
    no-search-results-message="No features match your search."
    wire:model.live="features"
/>
```

The search input placeholder uses `filament-tables::table.fields.search.placeholder`.
The "Select all" / "Deselect all" labels use `filament-forms::components.checkbox_list.actions.*`.
To publish the package's own translation strings:

```bash
php artisan vendor:publish --tag="filament-advanced-choice-translations"
```

### Customization

**Custom color:**

```blade
<x-advanced-choice::radio-card
    name="plan"
    :options="$plans"
    color="danger"
    wire:model.live="plan"
/>
```

**Hidden inputs with custom icon:**

```blade
<x-advanced-choice::checkbox-card
    name="features[]"
    :options="$features"
    hidden-inputs
    hidden-input-icon="heroicon-o-check"
    wire:model.live="features"
/>
```

**Disable cursor pointer:**

```blade
<x-advanced-choice::radio-list
    name="delivery"
    :options="$options"
    :cursor-pointer="false"
    wire:model.live="delivery"
/>
```

### Tailwind theme

Make sure your custom Filament theme includes the package's Blade views
so Tailwind classes are not purged:

```css
@source '../../../../vendor/codewithdennis/filament-advanced-choice/resources/**/*.blade.php';
```

If you are developing the package locally with a path repository and symlinks,
also add the absolute path to your theme file:

```css
@source '/absolute/path/to/filament-advanced-choice/resources/**/*.blade.php';
```

Run `npm run build` or `npm run dev` after adding the directive.

## Contributing

Contributions and pull requests are always welcome and appreciated. If you want to discuss a bigger idea first, feel free to open a GitHub issue, but you do not have to. When you open a PR, running `composer format` first helps keep CI green.

## Security

Report suspected vulnerabilities per [.github/SECURITY.md](.github/SECURITY.md). Do not post exploit details in a public issue.

## License

This package is released under the MIT License. The complete terms are in [LICENSE](LICENSE).
