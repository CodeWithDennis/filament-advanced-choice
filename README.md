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

### RadioCard

Card-based layout with descriptions and extras support.

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioCard;

RadioCard::make('mailing_list')
    ->options([
        'newsletter' => 'Newsletter',
        'existing_customers' => 'Existing customers',
        'trial_users' => 'Trial users',
    ])
    ->descriptions([
        'newsletter' => 'Last message sent an hour ago',
        'existing_customers' => 'Last message sent 2 weeks ago',
        'trial_users' => 'Last message sent 4 days ago',
    ])
    ->extras([
        'newsletter' => '621 users',
        'existing_customers' => '1200 users',
        'trial_users' => '2740 users',
    ])
```

## License

MIT License 