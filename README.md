<div align="center">

# 🤖 Bale Bot PHP SDK

**The modern, feature-rich, and unofficial PHP SDK for the [Bale Messenger Bot API](https://docs.bale.ai/).**

[![Tests](https://github.com/ErfanVahabpour/Bale-Bot-SDK/actions/workflows/ci.yml/badge.svg)](https://github.com/ErfanVahabpour/Bale-Bot-SDK/actions/workflows/ci.yml)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/erfanvahabpour/bale-bot-sdk.svg?style=flat-square&color=blue)](https://packagist.org/packages/erfanvahabpour/bale-bot-sdk)
[![PHP Version](https://img.shields.io/badge/PHP-%5E8.2-777bb4.svg?style=flat-square&logo=php)](https://php.net)
[![Laravel Support](https://img.shields.io/badge/Laravel-10%20%7C%2011%20%7C%2012%20%7C%2013-FF2D20.svg?style=flat-square&logo=laravel)](https://laravel.com)
[![Software License](https://img.shields.io/badge/license-BSD--4--Clause-green.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/erfanvahabpour/bale-bot-sdk.svg?style=flat-square&color=orange)](https://packagist.org/packages/erfanvahabpour/bale-bot-sdk)

<br />

[Features](#-key-features) •
[Installation](#-installation) •
[Laravel Setup](#-laravel-integration) •
[Quickstart](#-quick-start) •
[Usage Examples](#-usage-examples) •
[API Reference](#-api-method-reference) •
[Testing](#-testing) •
[License](#-license)

</div>

---

## ✨ Key Features

- ⚡ **Complete API Coverage** — Full support for all official endpoints from [docs.bale.ai](https://docs.bale.ai/) (Messages, Media, Chats, Webhooks, Payments, Commands, Stickers).
- 🚀 **Laravel 10, 11, 12 & 13 Ready** — Auto-discovered Service Provider, Facade (`Bale::`), and config publishing.
- 🤖 **Multi-Bot Management** — Seamlessly manage and toggle between multiple bot instances in a single application.
- 🎯 **Webhook & Long Polling** — Simple webhook handling in controllers and CLI polling with event dispatching.
- 💳 **Bale Payments** — Create invoice links, send invoices, handle `pre_checkout_query`, and inquire transaction statuses.
- 💬 **Interactive Keyboards & Mini-Apps** — Support for Inline Keyboards, Reply Keyboards, Web Apps (`WebAppData`, `WebAppInfo`), and Copy Text buttons.
- 🔔 **Event Dispatcher** — Built-in event system powered by `Illuminate\Events` for clean decoupled update handling.
- 🛡️ **Modern & Secure** — Built for PHP 8.2+, strictly typed, fully covered by automated PHPUnit tests.

---

## 📋 Requirements

| Requirement | Minimum Version |
|---|---|
| **PHP** | `>= 8.2` |
| **Laravel** *(optional)* | `^10.0 \| ^11.0 \| ^12.0 \| ^13.0` |
| **Required PHP Extensions** | `ext-json`, `ext-curl`, `ext-mbstring` |

---

## 📦 Installation

Install the package via Composer:

```bash
composer require erfanvahabpour/bale-bot-sdk
```

---

## 🚀 Laravel Integration

### 1. Publish Configuration

The package automatically registers its Service Provider and `Bale` Facade. Publish the configuration file:

```bash
php artisan vendor:publish --tag="bale-config"
```

This creates `config/bale.php`.

### 2. Configure Environment Variables

Add your bot token to your `.env` file:

```env
BALE_BOT_TOKEN=your_bot_token_here
```

### 3. Multi-Bot Configuration (Optional)

Configure multiple bots in `config/bale.php`:

```php
return [
    'default' => env('BALE_BOT_NAME', 'main_bot'),

    'bots' => [
        'main_bot' => [
            'token' => env('BALE_BOT_TOKEN'),
        ],
        'support_bot' => [
            'token' => env('BALE_SUPPORT_BOT_TOKEN'),
        ],
    ],
];
```

---

## 🏁 Quick Start

### In Standalone PHP

```php
use EFive\Bale\Api;

$bale = new Api('YOUR_BOT_TOKEN');

// Test authentication
$botUser = $bale->getMe();
echo "Connected as @{$botUser->username} (ID: {$botUser->id})";

// Send a message
$bale->sendMessage([
    'chat_id' => '123456789',
    'text'    => 'Hello from Bale Bot PHP SDK! 🚀',
]);
```

### In Laravel

```php
use EFive\Bale\Laravel\Facades\Bale;

// Uses default bot from config/bale.php
Bale::sendMessage([
    'chat_id' => '123456789',
    'text'    => 'Hello from Laravel! 🎉',
]);

// Or target a specific configured bot:
Bale::bot('support_bot')->sendMessage([
    'chat_id' => '123456789',
    'text'    => 'Support message',
]);
```

---

## 💡 Usage Examples

### 1. Sending Messages with Inline Keyboards

```php
use EFive\Bale\Laravel\Facades\Bale;

$replyMarkup = [
    'inline_keyboard' => [
        [
            ['text' => '🌐 Open Website', 'url' => 'https://bale.ai'],
            ['text' => '👍 Like', 'callback_data' => 'action_like'],
        ],
        [
            ['text' => '🚀 Launch Mini-App', 'web_app' => ['url' => 'https://app.example.com']],
        ],
    ],
];

Bale::sendMessage([
    'chat_id'      => '123456789',
    'text'         => 'Choose an option below:',
    'reply_markup' => $replyMarkup,
]);
```

### 2. Sending Photos & Media Files

Upload local files, stream resources, or send existing `file_id`s:

```php
use EFive\Bale\FileUpload\InputFile;
use EFive\Bale\Laravel\Facades\Bale;

// Upload local image
Bale::sendPhoto([
    'chat_id' => '123456789',
    'photo'   => InputFile::file('/path/to/image.png'),
    'caption' => 'Check out this photo! 📸',
]);

// Send document from raw string content on the fly
Bale::sendDocument([
    'chat_id'  => '123456789',
    'document' => InputFile::createFromContents('Invoice #10023...', 'invoice.txt'),
    'caption'  => 'Your invoice document',
]);

// Send Chat Action (typing indicator)
Bale::sendChatAction([
    'chat_id' => '123456789',
    'action'  => 'upload_photo',
]);
```

### 3. Handling Webhooks in Laravel

Define a route in `routes/api.php` or `routes/web.php`:

```php
use Illuminate\Http\Request;
use EFive\Bale\Laravel\Facades\Bale;

Route::post('/bale/webhook', function (Request $request) {
    $update = Bale::getWebhookUpdate();

    if ($update->isType('message')) {
        $message = $update->message;
        $chatId  = $message->chat->id;
        $text    = $message->text;

        if ($text === '/start') {
            Bale::sendMessage([
                'chat_id' => $chatId,
                'text'    => "Welcome, {$message->from->first_name}!",
            ]);
        }
    } elseif ($update->isType('callback_query')) {
        $callback = $update->callbackQuery;

        Bale::answerCallbackQuery([
            'callback_query_id' => $callback->id,
            'text'              => 'Action received!',
            'show_alert'        => false,
        ]);
    }

    return response()->json(['ok' => true]);
});
```

### 4. Setting & Deleting Webhook

```php
// Register webhook URL
Bale::setWebhook([
    'url' => 'https://yourdomain.com/api/bale/webhook',
]);

// Delete webhook
Bale::deleteWebhook();

// Get current webhook info
$info = Bale::getWebhookInfo();
echo $info->url;
```

### 5. Managing Chat Members & Admins

```php
// Get list of chat administrators
$admins = Bale::getChatAdministrators(['chat_id' => '-100123456789']);
foreach ($admins as $admin) {
    echo "{$admin->user->first_name} ({$admin->status})\n";
}

// Get specific member info
$member = Bale::getChatMember([
    'chat_id' => '-100123456789',
    'user_id' => 123456,
]);

// Promote member
Bale::promoteChatMember([
    'chat_id'             => '-100123456789',
    'user_id'             => 123456,
    'can_delete_messages' => true,
    'can_pin_messages'    => true,
]);

// Ban and Unban
Bale::banChatMember(['chat_id' => '-100123456789', 'user_id' => 123456]);
Bale::unbanChatMember(['chat_id' => '-100123456789', 'user_id' => 123456]);
```

### 6. Payments & Invoices

```php
// 1. Send an invoice in chat
Bale::sendInvoice([
    'chat_id'        => '123456789',
    'title'          => 'Premium Subscription',
    'description'    => '1-month access to premium content',
    'payload'        => 'sub_monthly_user_123',
    'provider_token' => 'YOUR_PROVIDER_TOKEN',
    'prices'         => [
        ['label' => 'Subtotal', 'amount' => 500000],
    ],
]);

// 2. Generate a shareable invoice payment link
$invoiceUrl = Bale::createInvoiceLink([
    'title'          => 'Product Name',
    'description'    => 'Product Description',
    'payload'        => 'order_9988',
    'provider_token' => 'YOUR_PROVIDER_TOKEN',
    'prices'         => [
        ['label' => 'Price', 'amount' => 250000],
    ],
]);

// 3. Answer Pre-Checkout Query (in webhook)
if ($update->isType('pre_checkout_query')) {
    Bale::answerPreCheckoutQuery([
        'pre_checkout_query_id' => $update->pre_checkout_query->id,
        'ok'                    => true,
    ]);
}

// 4. Inquire transaction status
$transaction = Bale::inquireTransaction([
    'payment_charge_id' => 'chg_123456',
]);
echo "Status: {$transaction->status}";
```

---

## 📚 API Method Reference

All methods return strongly-typed `BaseObject` models or booleans:

| Category | Available Methods |
|---|---|
| **Bot & Updates** | `getMe`, `getUpdates`, `setWebhook`, `deleteWebhook`, `removeWebhook`, `getWebhookInfo`, `getWebhookUpdate` |
| **Messaging** | `sendMessage`, `forwardMessage`, `copyMessage`, `editMessageText`, `editMessageCaption`, `editMessageReplyMarkup`, `deleteMessage`, `sendChatAction` |
| **Media Uploads** | `sendPhoto`, `sendAudio`, `sendDocument`, `sendVideo`, `sendAnimation`, `sendVoice`, `sendMediaGroup`, `getFile`, `downloadFile` |
| **Chat Management** | `getChat`, `getChatAdministrators`, `getChatMembersCount`, `getChatMember`, `banChatMember`, `unbanChatMember`, `promoteChatMember`, `leaveChat`, `setChatTitle`, `setChatDescription`, `setChatPhoto`, `deleteChatPhoto`, `pinChatMessage`, `unpinChatMessage`, `unpinAllChatMessages`, `createChatInviteLink`, `revokeChatInviteLink`, `exportChatInviteLink` |
| **Interactions** | `answerCallbackQuery`, `askReview`, `sendContact`, `sendLocation` |
| **Payments** | `sendInvoice`, `createInvoiceLink`, `answerPreCheckoutQuery`, `inquireTransaction` |
| **Commands** | `setMyCommands`, `deleteMyCommands`, `getMyCommands` |
| **Stickers** | `sendSticker`, `uploadStickerFile`, `createNewStickerSet`, `addStickerToSet` |

---

## 🧪 Testing

Run the test suite using PHPUnit:

```bash
composer test
# or
./vendor/bin/phpunit
```

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request or open an Issue.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Ensure all tests pass (`composer test`)
5. Push to the branch (`git push origin feature/amazing-feature`)
6. Open a Pull Request

---

## 💖 Funding & Support

If this SDK helps you build your bots, please consider supporting the project:

- **Email**: [info@efive.net](mailto:info@efive.net)
- **Website**: [efive.net](https://efive.net)
- **Donate**: [Aqayepardakht](https://aqayepardakht.ir/efive)

---

## 📄 License & Disclaimer

- **License**: Released under the [BSD 4-Clause License](LICENSE.md).
- **Disclaimer**: This project is an unofficial community library and is not officially affiliated with or endorsed by Bale.
