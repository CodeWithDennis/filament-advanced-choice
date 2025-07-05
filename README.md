# Filament Advanced Choice

Beautifully styled radio and checkbox group components for FilamentPHP with descriptions and modern design.

## Installation

```bash
composer require codewithdennis/filament-advanced-choice
```

## Components

### CheckboxList

Vertical list layout with descriptions for multiple selections.

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxList;

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
```

### CheckboxCards

Card-based layout with descriptions and extras support for multiple selections.

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxCards;

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
```

### CheckboxStackedCards

Stacked card layout with descriptions and extras support for multiple selections.

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxStackedCards;

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
```

### CheckboxTable

Responsive table layout with descriptions for multiple selections.

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxTable;

CheckboxTable::make('hosting')
    ->options([
        'shared' => 'Shared Hosting',
        'vps' => 'VPS Hosting',
    ])
    ->descriptions([
        'shared' => 'Perfect for small websites',
        'vps' => 'Scalable virtual server',
    ])
```

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

### RadioCards

Card-based layout with descriptions and extras support.

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioCards;

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
```

### RadioStackedCards

Stacked card layout with descriptions and extras support.

```php
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioStackedCards;

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
```

## Customization

### Colors

All components support custom colors using Filament's color system. The default color is `primary`, but you can customize it to any of Filament's supported colors.

```php
CheckboxCards::make('features')
    ->options([
        'email' => 'Email Support',
        'phone' => 'Phone Support',
    ])
    ->color('success') // Use success color
    ->color('warning') // Use warning color
    ->color('danger')  // Use danger color
    ->color('info')    // Use info color
    ->color('gray')    // Use gray color
    ->color('slate')   // Use slate color
    ->color('zinc')    // Use zinc color
    ->color('neutral') // Use neutral color
    ->color('stone')   // Use stone color
    ->color('red')     // Use red color
    ->color('orange')  // Use orange color
    ->color('amber')   // Use amber color
    ->color('yellow')  // Use yellow color
    ->color('lime')    // Use lime color
    ->color('green')   // Use green color
    ->color('emerald') // Use emerald color
    ->color('teal')    // Use teal color
    ->color('cyan')    // Use cyan color
    ->color('sky')     // Use sky color
    ->color('blue')    // Use blue color
    ->color('indigo')  // Use indigo color
    ->color('violet')  // Use violet color
    ->color('purple')  // Use purple color
    ->color('fuchsia') // Use fuchsia color
    ->color('pink')    // Use pink color
    ->color('rose')    // Use rose color
```

The color will be applied to:
- Selected state borders and backgrounds
- Focus outlines
- Check/radio button indicators
- Icons and visual elements

## License

MIT License 