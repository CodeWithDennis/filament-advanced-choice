# Filament Advanced Choice

Beautifully styled radio group components for FilamentPHP with descriptions and modern design.

## Installation

```bash
composer require codewithdennis/filament-advanced-choice
```

## Components

### RadioList

Vertical list layout with descriptions.

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioList;

RadioList::make('plan')
    ->options([
        'basic' => 'Basic Plan',
        'pro' => 'Pro Plan',
    ])
    ->descriptions([
        'basic' => 'Perfect for small teams',
        'pro' => 'Ideal for growing businesses',
    ])
```

### RadioTable

Responsive table layout with descriptions.

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioTable;

RadioTable::make('hosting')
    ->options([
        'shared' => 'Shared Hosting',
        'vps' => 'VPS Hosting',
    ])
    ->descriptions([
        'shared' => 'Perfect for small websites',
        'vps' => 'Scalable virtual server',
    ])
```

## License

MIT License 