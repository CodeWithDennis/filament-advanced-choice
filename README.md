# Filament Advanced Choice

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithdennis/filament-advanced-choice.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-advanced-choice)
[![Total Downloads](https://img.shields.io/packagist/dt/codewithdennis/filament-advanced-choice.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-advanced-choice)

Eight form fields that turn a plain radio or checkbox list into something worth clicking: cards, stacked cards, tables and richer lists, each able to carry a description and an extra column of information.

<img width="3840" height="2160" alt="Filament Advanced Choice" src="https://github.com/user-attachments/assets/d499f42f-9a2d-4d8c-87ce-e5d4f1dba613" />

Four fields extend Filament's `Radio` for single choice, four extend `CheckboxList` for multiple choice. They inherit the full API of the field they extend, so `searchable()`, `bulkToggleable()`, `disableOptionWhen()`, validation and state handling all work exactly as you already know them.

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioCard;

RadioCard::make('plan')
    ->options([
        'hobby' => 'Hobby',
        'pro' => 'Pro',
        'team' => 'Team',
    ])
    ->descriptions([
        'hobby' => 'For side projects and experiments.',
        'pro' => 'For freelancers shipping client work.',
        'team' => 'For teams that need shared billing.',
    ])
    ->extras([
        'hobby' => 'Free',
        'pro' => '$29 / month',
        'team' => '$99 / month',
    ]);
```

Screenshots of every layout are at the [bottom of this page](#screenshots).

## Requirements

- Filament 4.x or 5.x

## Installation

**1.** Install the package:

```bash
composer require codewithdennis/filament-advanced-choice
```

**2.** Register the views as a Tailwind source in your [custom Filament theme](https://filamentphp.com/docs/styling/overview), so the utility classes these fields use end up in your CSS:

```css
@source '../../../../vendor/codewithdennis/filament-advanced-choice/resources/**/*.blade.php';
```

**3.** Rebuild the theme:

```bash
npm run build
```

> [!IMPORTANT]
> Skipping step 2 is the most common reason fields render unstyled. If a field looks like a plain list of checkboxes, the theme has not picked up these views yet. The same applies after upgrading: run `npm run build` again so new utility classes are compiled.

## The fields

All eight live in `CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components`.

| Field                 | Selection | Layout                                            |
|-----------------------|-----------|---------------------------------------------------|
| `RadioList`           | Single    | Vertical list                                     |
| `RadioTable`          | Single    | Table, one option per row                         |
| `RadioCard`           | Single    | Grid of cards, 3 columns by default               |
| `RadioStackedCard`    | Single    | Cards stacked full width                          |
| `CheckboxList`        | Multiple  | Vertical list                                     |
| `CheckboxTable`       | Multiple  | Table, one option per row                         |
| `CheckboxCard`        | Multiple  | Grid of cards, 3 columns by default               |
| `CheckboxStackedCard` | Multiple  | Cards stacked full width                          |

> [!NOTE]
> The plural class names (`RadioCards`, `RadioStackedCards`, `CheckboxCards`, `CheckboxStackedCards`) still exist as deprecated aliases. Use the singular names in new code.

## Describing your options

Every field takes the same three pieces of content, all keyed by option value.

| Method           | Shows as                                            |
|------------------|-----------------------------------------------------|
| `options()`      | The label                                           |
| `descriptions()` | A subtitle under the label                          |
| `extras()`       | A trailing column, ideal for a price, count or hint |

`descriptions()` and `extras()` are optional and can be used independently.

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxStackedCard;

CheckboxStackedCard::make('delivery_type')
    ->options([
        'standard' => 'Standard delivery',
        'express' => 'Express delivery',
        'overnight' => 'Overnight delivery',
    ])
    ->descriptions([
        'standard' => 'Arrives within 5 to 7 business days.',
        'express' => 'Arrives within 2 to 3 business days.',
        'overnight' => 'Arrives the next business day.',
    ])
    ->extras([
        'standard' => '$5.00',
        'express' => '$10.00',
        'overnight' => '$20.00',
    ]);
```

### Using an enum instead

Pass a backed enum to `options()` and every field reads its content from the enum itself. Implement the contract for each piece you need:

| Contract                                                             | Provides            |
|----------------------------------------------------------------------|---------------------|
| `Filament\Support\Contracts\HasLabel`                                | The label           |
| `Filament\Support\Contracts\HasDescription`                          | The description     |
| `CodeWithDennis\FilamentAdvancedChoice\Filament\Interfaces\HasExtra` | The extras column   |
| `Filament\Support\Contracts\HasColor`                                | A colour for that single option, overriding the field colour. Honoured by the four `Radio` based fields only. |

```php
CheckboxStackedCard::make('delivery_type')
    ->options(DeliveryType::class);
```

<details>
<summary><strong>The enum behind that example</strong></summary>

```php
<?php

declare(strict_types=1);

namespace App\Enums;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Interfaces\HasExtra;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum DeliveryType: string implements HasDescription, HasExtra, HasLabel
{
    case Standard = 'standard';
    case Express = 'express';
    case Overnight = 'overnight';

    public function getLabel(): string
    {
        return match ($this) {
            self::Standard => __('Standard delivery'),
            self::Express => __('Express delivery'),
            self::Overnight => __('Overnight delivery'),
        };
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::Standard => __('Arrives within 5 to 7 business days.'),
            self::Express => __('Arrives within 2 to 3 business days.'),
            self::Overnight => __('Arrives the next business day.'),
        };
    }

    public function getExtra(): ?string
    {
        return match ($this) {
            self::Standard => __('$5.00'),
            self::Express => __('$10.00'),
            self::Overnight => __('$20.00'),
        };
    }
}
```

</details>

You can still override individual pieces: `extras()` passed explicitly wins over `getExtra()` on the cases.

## Inherited behaviour

These come straight from Filament's `Radio` and `CheckboxList`, unchanged.

### Searching

Available on all eight fields. The search box filters on labels and descriptions.

```php
CheckboxTable::make('delivery_type')
    ->options(DeliveryType::class)
    ->searchable()
    ->searchPrompt('Search delivery types...')
    ->noSearchResultsMessage('No delivery type matches your search.');
```

### Selecting everything at once

Multiple choice fields only.

```php
CheckboxCard::make('delivery_type')
    ->options(DeliveryType::class)
    ->bulkToggleable();
```

### Disabling individual options

Disabled options are dimmed, unclickable and keep the `not-allowed` cursor.

```php
CheckboxList::make('delivery_type')
    ->options(DeliveryType::class)
    ->disableOptionWhen(fn (string $value): bool => $value === 'overnight');
```

### Limiting how many can be picked

Multiple choice fields only.

```php
CheckboxCard::make('delivery_type')
    ->options(DeliveryType::class)
    ->minItems(1)
    ->maxItems(3);
```

## Customization

### Columns

The card layouts arrange their options in a grid. `RadioCard` and `CheckboxCard` default to three columns, `CheckboxStackedCard` to one. Pass a number, or an array keyed by breakpoint.

```php
RadioCard::make('delivery_type')
    ->options(DeliveryType::class)
    ->columns(4);

RadioCard::make('delivery_type')
    ->options(DeliveryType::class)
    ->columns([
        'default' => 1,
        'md' => 2,
        'xl' => 4,
    ]);
```

Use `gridDirection(GridDirection::Column)` to fill the grid top to bottom instead of left to right.

### Colour

Every field is `primary` by default. Any Filament colour works.

```php
use Filament\Support\Colors\Color;

CheckboxCard::make('delivery_type')
    ->options(DeliveryType::class)
    ->color(Color::Rose);
```

### Hiding the native inputs

The whole option is clickable, so the checkbox or radio dot is often redundant. `hiddenInputs()` removes it while keeping the option selectable and accessible: a transparent input is stretched across the option instead.

```php
CheckboxCard::make('delivery_type')
    ->options(DeliveryType::class)
    ->hiddenInputs();
```

Supported by the card and list layouts. `RadioTable` and `CheckboxTable` always show their native inputs and ignore this method.

On the four card layouts you can pair it with `hiddenInputIcon()`, which marks the selected card with an icon in its top right corner:

```php
RadioCard::make('delivery_type')
    ->options(DeliveryType::class)
    ->hiddenInputs()
    ->hiddenInputIcon('heroicon-s-check-circle');
```

> [!NOTE]
> There is no default icon. Without `hiddenInputIcon()`, a selected card is marked by its outline alone.

`visibleInputs()` reverses `hiddenInputs()`.

### Cursor

Because the entire option is clickable, all eight fields show a pointer cursor by default. Opt out per field with `defaultCursor()`:

```php
CheckboxCard::make('delivery_type')
    ->options(DeliveryType::class)
    ->defaultCursor();
```

`cursorPointer()` reverses `defaultCursor()`. Both accept a boolean or a `Closure`, so the cursor can follow other state:

```php
RadioCard::make('delivery_type')
    ->options(DeliveryType::class)
    ->defaultCursor(fn (): bool => ! auth()->user()->canChooseDelivery());
```

Disabled options keep the `not-allowed` cursor either way.

## Putting it together

A single choice field driven by an enum, laid out as cards without native inputs:

```php
use App\Enums\DeliveryType;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioCard;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;

public static function configure(Schema $schema): Schema
{
    return $schema
        ->components([
            RadioCard::make('delivery_type')
                ->label('How should we ship this?')
                ->options(DeliveryType::class)
                ->default(DeliveryType::Standard->value)
                ->required()
                ->columns(3)
                ->color(Color::Indigo)
                ->hiddenInputs()
                ->hiddenInputIcon('heroicon-s-check-circle')
                ->columnSpanFull(),
        ]);
}
```

## Screenshots

Each example below uses the same options, descriptions and extras, so the layouts can be compared directly.

### Single choice

<table>
<tr>
<td width="50%"><strong>RadioList</strong><br><img src="art/basic_radio_list.png" alt="RadioList"></td>
<td width="50%"><strong>RadioTable</strong><br><img src="art/basic_radio_table.png" alt="RadioTable"></td>
</tr>
<tr>
<td width="50%"><strong>RadioCard</strong><br><img src="art/basic_radio_cards.png" alt="RadioCard"></td>
<td width="50%"><strong>RadioStackedCard</strong><br><img src="art/basic_radio_stacked_cards.png" alt="RadioStackedCard"></td>
</tr>
</table>

### Multiple choice

<table>
<tr>
<td width="50%"><strong>CheckboxList</strong><br><img src="art/basic_checkbox_list.png" alt="CheckboxList"></td>
<td width="50%"><strong>CheckboxTable</strong><br><img src="art/basic_checkbox_table.png" alt="CheckboxTable"></td>
</tr>
<tr>
<td width="50%"><strong>CheckboxCard</strong><br><img src="art/basic_checkbox_cards.png" alt="CheckboxCard"></td>
<td width="50%"><strong>CheckboxStackedCard</strong><br><img src="art/basic_checkbox_stacked_cards.png" alt="CheckboxStackedCard"></td>
</tr>
</table>

## Contributing

Contributions and pull requests are always welcome. If you want to discuss a bigger idea first, open an issue, but you do not have to. Running `composer format` before you open a PR helps keep CI green.

## Security

Report suspected vulnerabilities per [.github/SECURITY.md](.github/SECURITY.md). Do not post exploit details in a public issue.

## License

This package is released under the MIT License. The complete terms are in [LICENSE](LICENSE).
