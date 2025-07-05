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
    ->hiddenInputs()
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
    ->visibleInputs()
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
    ->hiddenInputs()
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
    ->visibleInputs()
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
    ->hiddenInputs()
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
    ->visibleInputs()
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
    ->hiddenInputs()
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
    ->hiddenInputs()
```

## Customization

### Input Visibility

Control whether the checkbox/radio inputs are visible or hidden. When hidden, the entire card/row becomes clickable and shows a checkmark icon when selected.

```php
// Hide inputs (entire card/row becomes clickable)
CheckboxCards::make('features')
    ->hiddenInputs()

// Show traditional inputs (default)
CheckboxCards::make('features')
    ->visibleInputs()

// Conditional hiding
CheckboxCards::make('features')
    ->hiddenInputs(fn() => auth()->user()->prefersHiddenInputs())
```

### Colors

All components support custom colors using Filament's color system. The default color is `primary`, but you can customize it to any of Filament's supported colors.

#### Using Color Enums (Recommended)

```php
use Filament\Support\Colors\Color;

CheckboxCards::make('features')
    ->options([
        'email' => 'Email Support',
        'phone' => 'Phone Support',
    ])
    ->color(Color::Amber)    // Use amber color
    ->color(Color::Blue)     // Use blue color
    ->color(Color::Cyan)     // Use cyan color
    ->color(Color::Danger)   // Use danger color
    ->color(Color::Emerald)  // Use emerald color
    ->color(Color::Fuchsia)  // Use fuchsia color
    ->color(Color::Gray)     // Use gray color
    ->color(Color::Green)    // Use green color
    ->color(Color::Indigo)   // Use indigo color
    ->color(Color::Info)     // Use info color
    ->color(Color::Lime)     // Use lime color
    ->color(Color::Neutral)  // Use neutral color
    ->color(Color::Orange)   // Use orange color
    ->color(Color::Pink)     // Use pink color
    ->color(Color::Primary)  // Use primary color
    ->color(Color::Purple)   // Use purple color
    ->color(Color::Red)      // Use red color
    ->color(Color::Rose)     // Use rose color
    ->color(Color::Sky)      // Use sky color
    ->color(Color::Slate)    // Use slate color
    ->color(Color::Stone)    // Use stone color
    ->color(Color::Success)  // Use success color
    ->color(Color::Teal)     // Use teal color
    ->color(Color::Violet)   // Use violet color
    ->color(Color::Warning)  // Use warning color
    ->color(Color::Yellow)   // Use yellow color
    ->color(Color::Zinc)     // Use zinc color
```

#### Using String Values

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
