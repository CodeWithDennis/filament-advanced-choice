# Filament Advanced Choice

Beautifully styled radio and checkbox group components for FilamentPHP with descriptions and modern design.

## Installation

```bash
composer require codewithdennis/filament-advanced-choice
```

## Components

```php
use Filament\Support\Colors\Color;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxList;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxCards;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxStackedCards;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxTable;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioList;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioCards;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioStackedCards;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioTable;
```

### CheckboxList

Vertical list layout with descriptions for multiple selections.

```php
CheckboxList::make('features')
    ->options([
        'email' => 'Email Support',
        'phone' => 'Phone Support',
        'chat' => 'Live Chat',
        'priority' => 'Priority Support',
    ])
    ->descriptions([
        'email' => 'Response within 24 hours',
        'phone' => 'Available during business hours',
        'chat' => 'Instant support via chat',
        'priority' => 'Response within 2 hours',
    ])
    ->extras([
        'email' => 'Free',
        'phone' => '+$10/mo',
        'chat' => '+$5/mo',
        'priority' => '+$25/mo',
    ])
    ->color(Color::Success)
```

### CheckboxCards

Card-based layout with descriptions and extras support for multiple selections.

```php
CheckboxCards::make('mailing_list')
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
    ->color(Color::Blue)
```

### CheckboxStackedCards

Stacked card layout with descriptions and extras support for multiple selections.

```php
CheckboxStackedCards::make('server_plan')
    ->options([
        'hobby' => 'Hobby',
        'startup' => 'Startup',
        'business' => 'Business',
        'enterprise' => 'Enterprise',
    ])
    ->descriptions([
        'hobby' => '8GB / 4 CPUs • 160 GB SSD disk',
        'startup' => '12GB / 6 CPUs • 256 GB SSD disk',
        'business' => '16GB / 8 CPUs • 512 GB SSD disk',
        'enterprise' => '32GB / 12 CPUs • 1024 GB SSD disk',
    ])
    ->extras([
        'hobby' => '$40/mo',
        'startup' => '$80/mo',
        'business' => '$160/mo',
        'enterprise' => '$240/mo',
    ])
    ->color(Color::Emerald)
```

### CheckboxTable

Responsive table layout with descriptions for multiple selections.

```php
CheckboxTable::make('hosting')
    ->options([
        'shared' => 'Shared Hosting',
        'vps' => 'VPS Hosting',
    ])
    ->descriptions([
        'shared' => 'Perfect for small websites',
        'vps' => 'Scalable virtual server',
    ])
    ->color(Color::Purple)
```

### RadioList

Vertical list layout with descriptions.

```php
RadioList::make('plan')
    ->options([
        'basic' => 'Basic Plan',
        'pro' => 'Pro Plan',
    ])
    ->descriptions([
        'basic' => 'Perfect for small teams',
        'pro' => 'Ideal for growing businesses',
    ])
    ->color(Color::Indigo)
```

### RadioTable

Responsive table layout with descriptions.

```php
RadioTable::make('hosting')
    ->options([
        'shared' => 'Shared Hosting',
        'vps' => 'VPS Hosting',
    ])
    ->descriptions([
        'shared' => 'Perfect for small websites',
        'vps' => 'Scalable virtual server',
    ])
    ->color(Color::Teal)
```

### RadioCards

Card-based layout with descriptions and extras support.

```php
RadioCards::make('mailing_list')
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
    ->color(Color::Cyan)
```

### RadioStackedCards

Stacked card layout with descriptions and extras support.

```php
RadioStackedCards::make('server_plan')
    ->options([
        'hobby' => 'Hobby',
        'startup' => 'Startup',
        'business' => 'Business',
        'enterprise' => 'Enterprise',
    ])
    ->descriptions([
        'hobby' => '8GB / 4 CPUs • 160 GB SSD disk',
        'startup' => '12GB / 6 CPUs • 256 GB SSD disk',
        'business' => '16GB / 8 CPUs • 512 GB SSD disk',
        'enterprise' => '32GB / 12 CPUs • 1024 GB SSD disk',
    ])
    ->extras([
        'hobby' => '$40/mo',
        'startup' => '$80/mo',
        'business' => '$160/mo',
        'enterprise' => '$240/mo',
    ])
    ->color(Color::Violet)
```

## License

MIT License 
