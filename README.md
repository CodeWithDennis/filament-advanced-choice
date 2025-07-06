# Filament Advanced Choice

Beautifully styled radio and checkbox group components for FilamentPHP with descriptions and modern design.

## Installation

```bash
composer require codewithdennis/filament-advanced-choice
```

## Components

### CheckboxList

Vertical list layout with descriptions for multiple selections.

![basic_checkbox_list.png](art/basic_checkbox_list.png)

```php
CheckboxList::make('features')
    ->options([
        'email' => 'Email Support',
        'phone' => 'Phone Support',
        'chat' => 'Live Chat',
        'priority' => 'Priority Support',
        'ticket' => 'Ticket System',
        'knowledge_base' => 'Knowledge Base',
        'video_tutorials' => 'Video Tutorials',
        'webinar' => 'Webinar Access',
    ])
    ->descriptions([
        'email' => 'Response within 24 hours',
        'phone' => 'Available during business hours',
        'chat' => 'Instant support via chat',
        'priority' => 'Response within 2 hours',
        'ticket' => 'Track support requests',
        'knowledge_base' => 'Self-service documentation',
        'video_tutorials' => 'Step-by-step guides',
        'webinar' => 'Monthly training sessions',
    ])
    ->extras([
        'email' => 'Free',
        'phone' => '+$10/mo',
        'chat' => '+$5/mo',
        'priority' => '+$25/mo',
        'ticket' => '+$15/mo',
        'knowledge_base' => 'Free',
        'video_tutorials' => '+$8/mo',
        'webinar' => '+$20/mo',
    ])
    ->color(Color::Success)
    ->hiddenInputs()
    ->bulkToggleable()
```

### CheckboxCards

Card-based layout with descriptions and extras support for multiple selections.

![basic_checkbox_cards.png](art/basic_checkbox_cards.png)

```php
CheckboxCards::make('mailing_list')
    ->options([
        'newsletter' => 'Newsletter',
        'existing_customers' => 'Existing customers',
        'trial_users' => 'Trial users',
        'vip_customers' => 'VIP customers',
        'inactive_users' => 'Inactive users',
        'new_signups' => 'New signups',
    ])
    ->descriptions([
        'newsletter' => 'Last message sent an hour ago',
        'existing_customers' => 'Last message sent 2 weeks ago',
        'trial_users' => 'Last message sent 4 days ago',
        'vip_customers' => 'Last message sent 1 week ago',
        'inactive_users' => 'Last message sent 3 months ago',
        'new_signups' => 'Last message sent yesterday',
    ])
    ->extras([
        'newsletter' => '621 users',
        'existing_customers' => '1200 users',
        'trial_users' => '2740 users',
        'vip_customers' => '89 users',
        'inactive_users' => '450 users',
        'new_signups' => '156 users',
    ])
    ->color(Color::Blue)
    ->visibleInputs()
    ->bulkToggleable()
```

### CheckboxStackedCards

Stacked card layout with descriptions and extras support for multiple selections.

![basic_checkbox_stacked_cards.png](art/basic_checkbox_stacked_cards.png)

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
    ->bulkToggleable(),
```

### CheckboxTable

Responsive table layout with descriptions for multiple selections.

![basic_checkbox_table.png](art/basic_checkbox_table.png)

```php
CheckboxTable::make('hosting')
    ->options([
        'shared' => 'Shared Hosting',
        'vps' => 'VPS Hosting',
        'dedicated' => 'Dedicated Server',
        'cloud' => 'Cloud Hosting',
        'managed' => 'Managed Hosting',
    ])
    ->descriptions([
        'shared' => 'Perfect for small websites',
        'vps' => 'Scalable virtual server',
        'dedicated' => 'Full server control',
        'cloud' => 'Auto-scaling infrastructure',
        'managed' => 'Fully managed service',
    ])
    ->extras([
        'shared' => '$5/mo',
        'vps' => '$20/mo',
        'dedicated' => '$100/mo',
        'cloud' => '$50/mo',
        'managed' => '$75/mo',
    ])
    ->bulkToggleable(),
```

### RadioList

Vertical list layout with descriptions.

![basic_radio_list.png](art/basic_radio_list.png)

```php
RadioList::make('plan')
    ->options([
        'basic' => 'Basic Plan',
        'pro' => 'Pro Plan',
        'enterprise' => 'Enterprise Plan',
        'starter' => 'Starter Plan',
    ])
    ->descriptions([
        'basic' => 'Perfect for small teams',
        'pro' => 'Ideal for growing businesses',
        'enterprise' => 'For large organizations',
        'starter' => 'For individuals and freelancers',
    ])
    ->extras([
        'basic' => '$29/mo',
        'pro' => '$99/mo',
        'enterprise' => '$299/mo',
        'starter' => '$9/mo',
    ]),
```

### RadioTable

Responsive table layout with descriptions.

![basic_radio_table.png](art/basic_radio_table.png)

```php
RadioTable::make('hosting')
    ->options([
        'shared' => 'Shared Hosting',
        'vps' => 'VPS Hosting',
        'dedicated' => 'Dedicated Server',
        'cloud' => 'Cloud Hosting',
    ])
    ->descriptions([
        'shared' => 'Perfect for small websites',
        'vps' => 'Scalable virtual server',
        'dedicated' => 'Full server control',
        'cloud' => 'Auto-scaling infrastructure',
    ])
    ->extras([
        'shared' => '$5/mo',
        'vps' => '$20/mo',
        'dedicated' => '$100/mo',
        'cloud' => '$50/mo',
    ]),
```

### RadioCards

Card-based layout with descriptions and extras support.

![basic_radio_table.png](art/basic_radio_table.png)

```php
RadioCards::make('mailing_list')
    ->options([
        'newsletter' => 'Newsletter',
        'existing_customers' => 'Existing customers',
        'trial_users' => 'Trial users',
        'vip_customers' => 'VIP customers',
        'inactive_users' => 'Inactive users',
    ])
    ->descriptions([
        'newsletter' => 'Last message sent an hour ago',
        'existing_customers' => 'Last message sent 2 weeks ago',
        'trial_users' => 'Last message sent 4 days ago',
        'vip_customers' => 'Last message sent 1 week ago',
        'inactive_users' => 'Last message sent 3 months ago',
    ])
    ->extras([
        'newsletter' => '621 users',
        'existing_customers' => '1200 users',
        'trial_users' => '2740 users',
        'vip_customers' => '89 users',
        'inactive_users' => '450 users',
    ]),
```

### RadioStackedCards

Stacked card layout with descriptions and extras support.

![basic_radio_stacked_cards.png](art/basic_radio_stacked_cards.png)

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
    ]),
```

## Additional Features

### Searchable Options

All components support searchable functionality to help users find options quickly in large lists.

```php
CheckboxList::make('features')
    ->options([
        'email' => 'Email Support',
        'phone' => 'Phone Support',
        'chat' => 'Live Chat',
        'priority' => 'Priority Support',
        'ticket' => 'Ticket System',
        'knowledge_base' => 'Knowledge Base',
        'video_tutorials' => 'Video Tutorials',
        'webinar' => 'Webinar Access',
    ])
    ->descriptions([
        'email' => 'Response within 24 hours',
        'phone' => 'Available during business hours',
        'chat' => 'Instant support via chat',
        'priority' => 'Response within 2 hours',
        'ticket' => 'Track support requests',
        'knowledge_base' => 'Self-service documentation',
        'video_tutorials' => 'Step-by-step guides',
        'webinar' => 'Monthly training sessions',
    ])
    ->searchable()
    ->searchPrompt('Search support features...')
    ->noSearchResultsMessage('No support features found.')
```

### Disabling Specific Options

You can disable specific options based on conditions using the `disableOptionWhen()` method.

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
    ->disableOptionWhen(fn (string $value): bool => $value === 'priority')
```

### Bulk toggling checkboxes

Checkbox components support bulk select/deselect actions for better user experience.

```php
CheckboxList::make('features')
    ->options([
        'email' => 'Email Support',
        'phone' => 'Phone Support',
        'chat' => 'Live Chat',
        'priority' => 'Priority Support',
    ])
    ->bulkToggleable()
```

## Enum Support

You can use PHP enums with all components. When using enums, you need to implement Filament's `HasLabel` and `HasDescription` interfaces, plus the `HasExtra` interface from this package to provide labels, descriptions, and extras.

First, create your enum implementing the required interfaces:

<details>
<summary><strong>📋 Enum Implementation Code</strong></summary>

```php
<?php

declare(strict_types=1);

namespace App\Enums;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Enums\Concerns\HasExtra;
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

Then use it in your form:

<details>
<summary><strong>📋 Form Usage Code</strong></summary>

```php
use App\Enums\DeliveryTypeEnum;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\RadioStackedCards;

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

## Customization

### Input Visibility

Control whether the inputs are visible or hidden.

```php
CheckboxCards::make('features')
    ->hiddenInputs()
```

```php
CheckboxCards::make('features')
    ->visibleInputs()
```

### Colors

All components support custom colors using Filament's color system. The default color is `primary`, but you can customize it to any of Filament's supported colors.

#### Using Color Enums (Recommended)

```php
use Filament\Support\Colors\Color;

CheckboxCards::make('features')
    ->color(Color::Amber)
```
