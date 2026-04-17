# Filament Advanced Choice

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithdennis/filament-advanced-choice.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-advanced-choice)
[![Total Downloads](https://img.shields.io/packagist/dt/codewithdennis/filament-advanced-choice.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-advanced-choice)
[![License](https://img.shields.io/packagist/l/codewithdennis/filament-advanced-choice.svg?style=flat-square)](https://github.com/codewithdennis/filament-advanced-choice/blob/main/LICENSE)

**Filament Advanced Choice** adds eight opinionated form field variants—four for single choice (radio) and four for multiple choice (checkbox)—built on top of FilamentPHP’s native `Radio` and `CheckboxList` APIs. Each layout is styled for clarity, supports rich option metadata (descriptions, extras, optional per-option colors), and stays familiar to anyone who already uses FilamentPHP forms.

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

Checkbox variants extend FilamentPHP’s `CheckboxList`, so multiple selection works the same way:

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxCards;

CheckboxCards::make('addons')
    ->options([/* ... */])
    ->bulkToggleable()
    ->searchable();
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

Import namespace:

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioList;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioCards;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioStackedCards;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioTable;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxList;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxCards;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxStackedCards;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxTable;
```

## Search, bulk actions, and disabling options

**Search** (all components):

```php
RadioList::make('country')
    ->options(/* ... */)
    ->searchable()
    ->searchPrompt(__('Search countries…'))
    ->noSearchResultsMessage(__('No countries match your search.'));
```

**Bulk select / deselect** (checkbox components only):

```php
CheckboxList::make('tags')
    ->options(/* ... */)
    ->bulkToggleable();
```

**Disable individual options** (inherited from FilamentPHP):

```php
CheckboxCards::make('tiers')
    ->options(/* ... */)
    ->disableOptionWhen(fn (string $value): bool => $value === 'enterprise');
```

## Enums, labels, descriptions, and extras

You can pass a **backed enum** to `options()`. For labels and descriptions, implement `Filament\Support\Contracts\HasLabel` and `Filament\Support\Contracts\HasDescription`.

For the extra column (pricing, badges, etc.), implement this package’s `HasExtra` interface:

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Interfaces\HasExtra;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum Plan: string implements HasLabel, HasDescription, HasExtra
{
    case Hobby = 'hobby';
    case Pro = 'pro';

    public function getLabel(): string
    {
        return match ($this) {
            self::Hobby => __('Hobby'),
            self::Pro => __('Pro'),
        };
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::Hobby => __('For individuals'),
            self::Pro => __('For growing teams'),
        };
    }

    public function getExtra(): string | \Illuminate\Contracts\Support\Htmlable | null
    {
        return match ($this) {
            self::Hobby => '$9',
            self::Pro => '$29',
        };
    }
}
```

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
RadioCards::make('plan')
    ->options(Plan::class)
    ->hiddenInputs()
    ->hiddenInputIcon('heroicon-o-check-circle');
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
