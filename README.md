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

🌐 **Language / زبان:** **English** | [**فارسی (Persian)**](README.fa.md)

<p align="center">
  <b>کتابخانه جامع و مدرن ساخت ربات پیام‌رسان بله برای PHP و لاراول (Laravel 10, 11, 12, 13)</b><br />
  <i>Modern, strongly-typed PHP 8.2+ SDK for Bale Messenger Bot API with full support for Webhooks, Inline Keyboards, Media uploads, and In-App Payments.</i>
</p>

</div>

---

## 🌟 Overview / معرفی

**Bale Bot PHP SDK** is an enterprise-grade, developer-friendly PHP library designed to seamlessly interact with the [Bale Messenger Bot API](https://docs.bale.ai/). Whether you are building an e-commerce assistant, customer support bot, payment automation service, or interactive mini-app in Standalone PHP or Laravel, this SDK offers an expressive, robust, and strongly-typed toolkit.

> [!NOTE]
> **راهنمای فارسی / Persian Documentation:**  
> اگر به دنبال ساخت ربات پیام‌رسان بله در زبان **PHP** یا فریم‌ورک **لاراول (Laravel 10, 11, 12, 13)** هستید، این کتابخانه کامل‌ترین SDK پی‌اچ‌پی برای وب‌سرویس بله است. تمامی قابلیت‌ها از جمله ارسال انواع پیام، دکمه‌های شیشه‌ای (Inline Keyboard)، وب‌هوک (Webhook)، درگاه پرداخت درون‌برنامه‌ای، آپلود رسانه و مدیریت چندین بات به طور کامل پیاده‌سازی شده‌اند. برای مطالعه راهنمای کامل به زبان فارسی به [**README.fa.md**](README.fa.md) مراجعه فرمایید.

---

## ✨ Key Features

- ⚡ **Complete API Coverage** — 100% full implementation of all official endpoints from [docs.bale.ai](https://docs.bale.ai/) (Messages, Media, Chats, Webhooks, Payments, Commands, Stickers).
- 🚀 **First-Class Laravel Support** — Auto-discovered Service Provider, Facade (`Bale::`), configuration publishing, Artisan CLI helpers, and IoC container resolution.
- 🤖 **Multi-Bot Manager** — Effortlessly configure and switch between multiple bot accounts in a single codebase (`Bale::bot('support_bot')`).
- 🎯 **Flexible Update Handling** — Built-in support for Webhook handling and Long-Polling CLI runners.
- 💳 **Bale In-App Payments** — Create digital invoice links, send structured invoices, handle pre-checkout verification, and query transaction statuses.
- 💬 **Interactive UI & Mini-Apps** — Support for Inline Keyboards, Reply Keyboards, WebApps / Mini-Apps (`WebAppInfo`), and Copy Text buttons.
- 🧠 **Command Bus System** — Create modular, self-contained Command classes with regex pattern arguments and automatic dependency injection.
- 🔔 **Event-Driven Architecture** — Decoupled event dispatcher (`UpdateWasReceived`) powered by `Illuminate\Events`.
- ⚡ **Async Requests & Custom Clients** — Make non-blocking asynchronous HTTP calls or plug in custom HTTP client handlers.
- 🛡️ **Modern & Secure** — Built for PHP 8.2+, strictly typed objects (`BaseObject`), and backed by comprehensive PHPUnit test suites.

---

## 📖 Table of Contents

- [Requirements](#-requirements)
- [Installation](#-installation)
- [Laravel Integration](#-laravel-integration)
  - [1. Publish Configuration](#1-publish-configuration)
  - [2. Configure Environment Variables](#2-configure-environment-variables)
  - [3. Multi-Bot Configuration](#3-multi-bot-configuration)
  - [4. Artisan CLI Commands](#4-artisan-cli-commands)
- [Quick Start](#-quick-start)
  - [In Standalone PHP](#in-standalone-php)
  - [In Laravel](#in-laravel)
- [Comprehensive Usage Guide](#-comprehensive-usage-guide)
  - [1. Sending & Managing Messages](#1-sending--managing-messages)
  - [2. Interactive Keyboards & Mini-Apps](#2-interactive-keyboards--mini-apps)
  - [3. Media & File Uploads](#3-media--file-uploads)
  - [4. Chat Actions & Typing Status](#4-chat-actions--typing-status)
  - [5. Chat, Group & Channel Administration](#5-chat-group--channel-administration)
  - [6. Webhooks & Polling Update Handling](#6-webhooks--polling-update-handling)
  - [7. Command Bus & Custom Commands](#7-command-bus--custom-commands)
  - [8. Bale In-App Payments & Invoices](#8-bale-in-app-payments--invoices)
  - [9. Stickers & Custom Sticker Sets](#9-stickers--custom-sticker-sets)
  - [10. Bot Commands Menu Management](#10-bot-commands-menu-management)
  - [11. Event Dispatcher & Listeners](#11-event-dispatcher--listeners)
  - [12. Error & Exception Handling](#12-error--exception-handling)
  - [13. Advanced Configuration & Custom Clients](#13-advanced-configuration--custom-clients)
- [API Method Reference](#-api-method-reference)
- [Frequently Asked Questions (FAQ)](#-frequently-asked-questions-faq--سوالات-متداول)
- [Testing](#-testing)
- [Contributing](#-contributing)
- [Funding & Support](#-funding--support)
- [License & Disclaimer](#-license--disclaimer)

---

## 📋 Requirements

| Requirement | Minimum Version | Notes |
|---|---|---|
| **PHP** | `>= 8.2` | PHP 8.2, 8.3, 8.4+ supported |
| **Laravel** *(Optional)* | `^10.0 \| ^11.0 \| ^12.0 \| ^13.0` | For Laravel-based projects |
| **Extensions** | `ext-json`, `ext-curl`, `ext-mbstring` | Required PHP core extensions |

---

## 📦 Installation

Install the package via Composer into your project:

```bash
composer require erfanvahabpour/bale-bot-sdk
```

---

## 🚀 Laravel Integration

### 1. Publish Configuration

The package registers `EFive\Bale\Laravel\BaleServiceProvider` and the `Bale` Facade automatically. Publish the configuration file:

```bash
php artisan vendor:publish --tag="bale-config"
```

This publishes `config/bale.php` into your Laravel application.

### 2. Configure Environment Variables

Add your bot token and optional parameters to your `.env` file:

```env
BALE_BOT_TOKEN=123456789:ABCdefGhIJKlmNoPQRsTUVwxyZ
BALE_BOT_NAME=main_bot
BALE_WEBHOOK_URL=https://yourdomain.com/api/bale/webhook
BALE_ASYNC_REQUESTS=false
```

### 3. Multi-Bot Configuration

Configure single or multiple bots in `config/bale.php`:

```php
return [
    'default' => env('BALE_BOT_NAME', 'main_bot'),

    'bots' => [
        'main_bot' => [
            'token'            => env('BALE_BOT_TOKEN'),
            'certificate_path' => env('BALE_CERTIFICATE_PATH'),
            'webhook_url'      => env('BALE_WEBHOOK_URL'),
            'allowed_updates'  => null,
            'commands'         => [
                // Acme\Project\Commands\StartCommand::class,
            ],
        ],

        'support_bot' => [
            'token'            => env('BALE_SUPPORT_BOT_TOKEN'),
            'webhook_url'      => env('BALE_SUPPORT_WEBHOOK_URL'),
            'commands'         => [
                // Acme\Project\Commands\SupportTicketCommand::class,
            ],
        ],
    ],

    'async_requests' => env('BALE_ASYNC_REQUESTS', false),
    'http_client_handler' => null,
    'base_bot_url' => null,
    'resolve_command_dependencies' => true,

    'commands' => [
        \EFive\Bale\Commands\HelpCommand::class,
    ],

    'command_groups' => [
        // 'admin' => [Acme\Project\Commands\BanUserCommand::class],
    ],

    'shared_commands' => [
        // 'start' => Acme\Project\Commands\StartCommand::class,
    ],
];
```

### 4. Artisan CLI Commands

Manage bot webhooks directly from the terminal:

```bash
# Setup webhook for the default bot
php artisan bale:webhook --setup

# Setup webhook for a specific bot
php artisan bale:webhook support_bot --setup

# Display current webhook status and info
php artisan bale:webhook --info

# Display webhook information for all configured bots
php artisan bale:webhook --info --all

# Remove active webhook
php artisan bale:webhook --remove
```

---

## 🏁 Quick Start

### In Standalone PHP

```php
require_once __DIR__ . '/vendor/autoload.php';

use EFive\Bale\Api;

$bale = new Api('YOUR_BOT_TOKEN');

// 1. Authenticate and retrieve bot profile
$botUser = $bale->getMe();
echo "Connected as @{$botUser->username} (ID: {$botUser->id})
";

// 2. Send a text message
$message = $bale->sendMessage([
    'chat_id' => '123456789',
    'text'    => 'Hello from Bale Bot PHP SDK! 🚀',
]);

echo "Message sent with ID: {$message->message_id}";
```

### In Laravel

```php
use EFive\Bale\Laravel\Facades\Bale;

// Uses default bot from config/bale.php
Bale::sendMessage([
    'chat_id' => '123456789',
    'text'    => 'Hello from Laravel! 🎉',
]);

// Or target a specific configured bot instance:
Bale::bot('support_bot')->sendMessage([
    'chat_id' => '123456789',
    'text'    => 'Support notification',
]);
```

---

## 💡 Comprehensive Usage Guide

### 1. Sending & Managing Messages

#### Plain & Formatted Messages
```php
use EFive\Bale\Laravel\Facades\Bale;

$response = Bale::sendMessage([
    'chat_id'                  => '123456789',
    'text'                     => '<b>Bold</b>, <i>Italic</i>, and <code>Code</code> message!',
    'parse_mode'               => 'HTML', // or 'Markdown'
    'disable_web_page_preview' => false,
]);
```

#### Forwarding & Copying Messages
```php
// Forward message (with original sender header)
Bale::forwardMessage([
    'chat_id'      => 'TARGET_CHAT_ID',
    'from_chat_id' => 'SOURCE_CHAT_ID',
    'message_id'   => 1024,
]);

// Copy message (without forward header)
$copiedId = Bale::copyMessage([
    'chat_id'      => 'TARGET_CHAT_ID',
    'from_chat_id' => 'SOURCE_CHAT_ID',
    'message_id'   => 1024,
    'caption'      => 'New custom caption for copied media',
]);
```

#### Editing & Deleting Messages
```php
// Edit message text
Bale::editMessageText([
    'chat_id'    => '123456789',
    'message_id' => 1024,
    'text'       => 'Updated text content.',
]);

// Edit media caption
Bale::editMessageCaption([
    'chat_id'    => '123456789',
    'message_id' => 1024,
    'caption'    => 'Updated photo caption.',
]);

// Delete message
Bale::deleteMessage([
    'chat_id'    => '123456789',
    'message_id' => 1024,
]);
```

---

### 2. Interactive Keyboards & Mini-Apps

#### Inline Keyboards (Buttons attached to messages)
```php
use EFive\Bale\Laravel\Facades\Bale;

$replyMarkup = [
    'inline_keyboard' => [
        [
            ['text' => '🌐 Visit Website', 'url' => 'https://bale.ai'],
            ['text' => '🔔 Subscribe', 'callback_data' => 'action_subscribe'],
        ],
        [
            // Open a Bale WebApp / Mini-App
            ['text' => '📱 Launch Mini-App', 'web_app' => ['url' => 'https://miniapp.example.com']],
            // Copy text button
            ['text' => '📋 Copy Promo Code', 'copy_text' => ['text' => 'DISCOUNT2026']],
        ],
    ],
];

Bale::sendMessage([
    'chat_id'      => '123456789',
    'text'         => 'Select an option from the menu:',
    'reply_markup' => $replyMarkup,
]);
```

#### Reply Keyboards (Custom bottom input buttons)
```php
$replyKeyboard = [
    'keyboard' => [
        [
            ['text' => '📦 View Products'],
            ['text' => '📞 Contact Us'],
        ],
        [
            ['text' => '📍 Send Location', 'request_location' => true],
            ['text' => '📱 Share Phone Number', 'request_contact' => true],
        ],
    ],
    'resize_keyboard'   => true,
    'one_time_keyboard' => false,
];

Bale::sendMessage([
    'chat_id'      => '123456789',
    'text'         => 'Welcome! Choose a menu action:',
    'reply_markup' => $replyKeyboard,
]);

// Remove Reply Keyboard
Bale::sendMessage([
    'chat_id'      => '123456789',
    'text'         => 'Keyboard removed.',
    'reply_markup' => ['remove_keyboard' => true],
]);
```

---

### 3. Media & File Uploads

The SDK provides the flexible `InputFile` helper which supports local files, remote URLs, raw string contents, or open stream resources.

```php
use EFive\Bale\FileUpload\InputFile;
use EFive\Bale\Laravel\Facades\Bale;

// 1. Send Photo from local filesystem
Bale::sendPhoto([
    'chat_id' => '123456789',
    'photo'   => InputFile::file('/path/to/banner.jpg'),
    'caption' => 'Check out our new release! 📸',
]);

// 2. Send Document from dynamic string content
Bale::sendDocument([
    'chat_id'  => '123456789',
    'document' => InputFile::createFromContents('Invoice Data: ...', 'invoice_982.txt'),
    'caption'  => 'Your monthly statement',
]);

// 3. Send Audio / MP3
Bale::sendAudio([
    'chat_id'   => '123456789',
    'audio'     => InputFile::file('/path/to/podcast.mp3'),
    'title'     => 'Episode 42',
    'performer' => 'Bale Podcast',
]);

// 4. Send Video & GIF Animations
Bale::sendVideo([
    'chat_id' => '123456789',
    'video'   => InputFile::file('/path/to/demo.mp4'),
    'caption' => 'Video tutorial 🎥',
]);

Bale::sendAnimation([
    'chat_id'   => '123456789',
    'animation' => InputFile::file('/path/to/sticker.gif'),
]);

// 5. Send Voice note
Bale::sendVoice([
    'chat_id' => '123456789',
    'voice'   => InputFile::file('/path/to/voice.ogg'),
]);

// 6. Send Media Group (Album)
Bale::sendMediaGroup([
    'chat_id' => '123456789',
    'media'   => [
        [
            'type'    => 'photo',
            'media'   => InputFile::file('/path/to/image1.jpg'),
            'caption' => 'Photo Album #1',
        ],
        [
            'type'  => 'photo',
            'media' => InputFile::file('/path/to/image2.jpg'),
        ],
    ],
]);
```

#### Downloading Files
```php
// Retrieve file metadata
$file = Bale::getFile(['file_id' => 'FILE_ID_FROM_UPDATE']);
echo "File size: {$file->file_size} bytes
";

// Download file to local storage
$savedPath = Bale::downloadFile($file, storage_path('app/downloads/' . basename($file->file_path)));
```

---

### 4. Chat Actions & Typing Status

Send temporary chat status indicators (e.g. typing, uploading photo, recording video):

```php
use EFive\Bale\Laravel\Facades\Bale;

// Possible actions: typing, upload_photo, record_video, upload_video, record_audio, upload_audio, upload_document, find_location
Bale::sendChatAction([
    'chat_id' => '123456789',
    'action'  => 'typing',
]);
```

---

### 5. Chat, Group & Channel Administration

Manage chats, admins, bans, permissions, and invite links:

```php
use EFive\Bale\Laravel\Facades\Bale;

$chatId = '-100123456789';

// 1. Get Chat information and member count
$chat = Bale::getChat(['chat_id' => $chatId]);
$membersCount = Bale::getChatMembersCount(['chat_id' => $chatId]);

// 2. Retrieve administrators list
$admins = Bale::getChatAdministrators(['chat_id' => $chatId]);
foreach ($admins as $admin) {
    echo "{$admin->user->first_name} - Status: {$admin->status}
";
}

// 3. Promote chat member
Bale::promoteChatMember([
    'chat_id'              => $chatId,
    'user_id'              => 123456,
    'can_change_info'      => true,
    'can_delete_messages'  => true,
    'can_invite_users'     => true,
    'can_restrict_members' => false,
    'can_pin_messages'     => true,
    'can_promote_members'  => false,
]);

// 4. Ban & Unban members
Bale::banChatMember(['chat_id' => $chatId, 'user_id' => 123456]);
Bale::unbanChatMember(['chat_id' => $chatId, 'user_id' => 123456]);

// 5. Pin and Unpin messages
Bale::pinChatMessage(['chat_id' => $chatId, 'message_id' => 1024, 'disable_notification' => false]);
Bale::unpinChatMessage(['chat_id' => $chatId, 'message_id' => 1024]);
Bale::unpinAllChatMessages(['chat_id' => $chatId]);

// 6. Manage Invite Links
$newInvite = Bale::createChatInviteLink([
    'chat_id'      => $chatId,
    'expire_date'  => time() + 86400,
    'member_limit' => 50,
]);
```

---

### 6. Webhooks & Polling Update Handling

#### Webhook Controller in Laravel
Define a webhook route in `routes/api.php`:

```php
use Illuminate\Http\Request;
use EFive\Bale\Laravel\Facades\Bale;

Route::post('/bale/webhook', function (Request $request) {
    // Automatically parses incoming request into Update object
    $update = Bale::getWebhookUpdate();

    // 1. Handle incoming text message
    if ($update->isType('message')) {
        $message = $update->message;
        $chatId  = $message->chat->id;
        $text    = $message->text;

        if ($text === '/start') {
            Bale::sendMessage([
                'chat_id' => $chatId,
                'text'    => "Hello {$message->from->first_name}! Welcome to our bot.",
            ]);
        }
    }

    // 2. Handle Inline Button Callbacks
    elseif ($update->isType('callback_query')) {
        $callback = $update->callbackQuery;

        // Answer callback to remove loading state on button
        Bale::answerCallbackQuery([
            'callback_query_id' => $callback->id,
            'text'              => 'Action performed successfully! ✅',
            'show_alert'        => false,
        ]);
    }

    return response()->json(['ok' => true]);
});
```

#### Long Polling in CLI Workers
For local development or daemon workers:

```php
use EFive\Bale\Api;

$bale = new Api('YOUR_BOT_TOKEN');

$offset = 0;
while (true) {
    $updates = $bale->getUpdates(['offset' => $offset, 'timeout' => 30]);

    foreach ($updates as $update) {
        $offset = $update->updateId + 1;

        if ($update->isType('message')) {
            $bale->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text'    => "Echo: " . $update->message->text,
            ]);
        }
    }
    sleep(1);
}
```

---

### 7. Command Bus & Custom Commands

The SDK includes a built-in Command Bus system. You can create organized Command classes that automatically resolve arguments, respond to updates, and leverage Laravel dependency injection.

#### Creating a Custom Command
Create a command class extending `EFive\Bale\Commands\Command`:

```php
namespace App\Bale\Commands;

use EFive\Bale\Commands\Command;
use App\Services\UserService;

class StartCommand extends Command
{
    /** @var string Command trigger */
    protected string $name = 'start';

    /** @var string[] Aliases */
    protected array $aliases = ['begin', 'welcome'];

    /** @var string Description */
    protected string $description = 'Start interaction with the bot';

    /** @var string Argument Pattern (e.g. /start {ref}) */
    protected string $pattern = '{ref}';

    // Automatic Dependency Injection via Laravel Container!
    public function __construct(protected UserService $userService)
    {
    }

    public function handle(): void
    {
        $user = $this->getUpdate()->getMessage()->from;
        $referral = $this->argument('ref', 'none');

        $this->userService->registerOrUpdate($user->id, $user->username);

        // Helper reply method (automatically populates chat_id)
        $this->replyWithMessage([
            'text' => "Welcome {$user->first_name}! (Referral: {$referral})",
            'reply_markup' => [
                'inline_keyboard' => [
                    [['text' => '🚀 Get Started', 'callback_data' => 'get_started']]
                ]
            ]
        ]);
    }
}
```

#### Registering & Processing Commands
In `config/bale.php`:
```php
'commands' => [
    \App\Bale\Commands\StartCommand::class,
    \EFive\Bale\Commands\HelpCommand::class,
],
```

In your webhook route:
```php
Route::post('/bale/webhook', function () {
    // Process inbound commands automatically
    Bale::commandsHandler(true);

    return response()->json(['ok' => true]);
});
```

---

### 8. Bale In-App Payments & Invoices

Integrate digital sales and payments natively within Bale Messenger using the Bale Banking API:

```php
use EFive\Bale\Laravel\Facades\Bale;

// 1. Send an Invoice in chat
Bale::sendInvoice([
    'chat_id'        => '123456789',
    'title'          => 'VIP Subscription',
    'description'    => '1-Month access to VIP trading channel',
    'payload'        => 'user_order_88319',
    'provider_token' => 'YOUR_PAYMENT_PROVIDER_TOKEN',
    'prices'         => [
        ['label' => 'Base Price', 'amount' => 500000], // Amount in Rials / Tomans
        ['label' => 'Tax', 'amount' => 45000],
    ],
]);

// 2. Generate a shareable Invoice Link
$paymentUrl = Bale::createInvoiceLink([
    'title'          => 'E-Book Download',
    'description'    => 'Full PDF Guide',
    'payload'        => 'ebook_order_102',
    'provider_token' => 'YOUR_PAYMENT_PROVIDER_TOKEN',
    'prices'         => [
        ['label' => 'Total', 'amount' => 150000],
    ],
]);

// 3. Handle Pre-Checkout Query in Webhook
if ($update->isType('pre_checkout_query')) {
    $queryId = $update->pre_checkout_query->id;

    // Verify stock or condition and approve payment
    Bale::answerPreCheckoutQuery([
        'pre_checkout_query_id' => $queryId,
        'ok'                    => true,
    ]);
}

// 4. Inquire Transaction Status
$transaction = Bale::inquireTransaction([
    'payment_charge_id' => 'chg_sample_id_123',
]);

echo "Transaction Status: {$transaction->status}
";
```

---

### 9. Stickers & Custom Sticker Sets

```php
use EFive\Bale\FileUpload\InputFile;
use EFive\Bale\Laravel\Facades\Bale;

// Send existing sticker by file_id
Bale::sendSticker([
    'chat_id' => '123456789',
    'sticker' => 'STICKER_FILE_ID',
]);

// Upload sticker image file
$file = Bale::uploadStickerFile([
    'user_id'        => 123456,
    'sticker'        => InputFile::file('/path/to/sticker.png'),
    'sticker_format' => 'static',
]);

// Create new sticker set
Bale::createNewStickerSet([
    'user_id'  => 123456,
    'name'     => 'animals_by_mybot',
    'title'    => 'Cool Animals Pack',
    'stickers' => [
        [
            'sticker'    => InputFile::file('/path/to/lion.png'),
            'emoji_list' => ['🦁', '👑'],
        ]
    ],
    'sticker_format' => 'static',
]);
```

---

### 10. Bot Commands Menu Management

Configure the command hints displayed to users in the Bale Messenger chat menu:

```php
use EFive\Bale\Laravel\Facades\Bale;

// Set Bot Commands
Bale::setMyCommands([
    'commands' => [
        ['command' => 'start', 'description' => 'Start the bot'],
        ['command' => 'help', 'description' => 'Show help menu'],
        ['command' => 'account', 'description' => 'Manage your subscription'],
    ],
]);

// Retrieve registered commands
$commands = Bale::getMyCommands();

// Clear commands menu
Bale::deleteMyCommands();
```

---

### 11. Event Dispatcher & Listeners

The SDK fires `EFive\Bale\Events\UpdateWasReceived` whenever an update is processed. In Laravel, you can register listeners in your `EventServiceProvider`:

```php
use EFive\Bale\Events\UpdateWasReceived;
use App\Listeners\LogBaleUpdateListener;

protected $listen = [
    UpdateWasReceived::class => [
        LogBaleUpdateListener::class,
    ],
];
```

In your listener:
```php
namespace App\Listeners;

use EFive\Bale\Events\UpdateWasReceived;

class LogBaleUpdateListener
{
    public function handle(UpdateWasReceived $event): void
    {
        $update = $event->update;
        $botApi = $event->bale;

        \Log::info('Received Bale Update ID: ' . $update->updateId);
    }
}
```

---

### 12. Error & Exception Handling

The SDK provides structured exceptions for robust error handling:

```php
use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Exceptions\BaleResponseException;
use EFive\Bale\Exceptions\BaleBotNotFoundException;

try {
    $response = Bale::sendMessage([
        'chat_id' => '123456789',
        'text'    => 'Test message',
    ]);
} catch (BaleResponseException $e) {
    // API returned error response
    echo "HTTP Status: " . $e->getHttpStatusCode();
    echo "Error Message: " . $e->getMessage();
    echo "Error Code: " . $e->getErrorCode();
    $rawResponse = $e->getRawResponse();
} catch (BaleBotNotFoundException $e) {
    // Referenced unconfigured bot name
    echo "Bot not found: " . $e->getMessage();
} catch (BaleSDKException $e) {
    // General SDK exception
    echo "SDK Error: " . $e->getMessage();
}
```

---

### 13. Advanced Configuration & Custom Clients

#### Asynchronous Non-Blocking Requests
Enable async requests globally in `.env` (`BALE_ASYNC_REQUESTS=true`) or per instance:

```php
$bale = new \EFive\Bale\Api('YOUR_TOKEN', async: true);
```

#### Custom Base URL / API Proxy
For local mock servers or custom Bale reverse proxies:

```php
$bale = new \EFive\Bale\Api('YOUR_TOKEN', baseBotUrl: 'https://proxy.example.com/bot');
```

#### Custom HTTP Client Handler
Implement `EFive\Bale\HttpClients\HttpClientInterface` to plug in your own HTTP transport client (e.g. customized cURL, Guzzle middleware stack, or HTTP/2 client).

---

## 📚 API Method Reference

All SDK methods return strongly-typed `BaseObject` models, arrays, or boolean statuses:

| Category | Method | Parameters | Return Type | Description |
|---|---|---|---|---|
| **Bot & Updates** | `getMe` | `[]` | `User` | Get bot profile information |
| | `getUpdates` | `['offset'?, 'limit'?, 'timeout'?, ...]` | `Update[]` | Poll for updates |
| | `setWebhook` | `['url', 'certificate'?, 'allowed_updates'?]` | `bool` | Set webhook URL |
| | `deleteWebhook` / `removeWebhook` | `[]` | `bool` | Remove current webhook |
| | `getWebhookInfo` | `[]` | `WebhookInfo` | Get current webhook status |
| | `getWebhookUpdate` | `[$shouldEmitEvents, $request]` | `Update` | Parse incoming webhook update |
| **Messaging** | `sendMessage` | `['chat_id', 'text', 'reply_markup'?, ...]` | `Message` | Send text message |
| | `forwardMessage` | `['chat_id', 'from_chat_id', 'message_id']` | `Message` | Forward existing message |
| | `copyMessage` | `['chat_id', 'from_chat_id', 'message_id', ...]` | `MessageId` | Copy message without forward tag |
| | `editMessageText` | `['chat_id', 'message_id', 'text', ...]` | `Message\|bool` | Edit message text |
| | `editMessageCaption` | `['chat_id', 'message_id', 'caption', ...]` | `Message\|bool` | Edit media caption |
| | `editMessageReplyMarkup` | `['chat_id', 'message_id', 'reply_markup']` | `Message\|bool` | Edit inline keyboard markup |
| | `deleteMessage` | `['chat_id', 'message_id']` | `bool` | Delete message |
| | `sendChatAction` | `['chat_id', 'action']` | `bool` | Broadcast chat status (e.g. typing) |
| | `askReview` | `['chat_id', ...]` | `Message` | Send review prompt |
| **Media Uploads** | `sendPhoto` | `['chat_id', 'photo', 'caption'?, ...]` | `Message` | Send photo |
| | `sendAudio` | `['chat_id', 'audio', 'caption'?, ...]` | `Message` | Send audio file |
| | `sendDocument` | `['chat_id', 'document', 'caption'?, ...]` | `Message` | Send general file / document |
| | `sendVideo` | `['chat_id', 'video', 'caption'?, ...]` | `Message` | Send video |
| | `sendAnimation` | `['chat_id', 'animation', 'caption'?, ...]` | `Message` | Send animation / GIF |
| | `sendVoice` | `['chat_id', 'voice', 'caption'?, ...]` | `Message` | Send voice audio message |
| | `sendMediaGroup` | `['chat_id', 'media']` | `Message[]` | Send photo/video album |
| | `sendLocation` | `['chat_id', 'latitude', 'longitude']` | `Message` | Send map location coordinates |
| | `sendContact` | `['chat_id', 'phone_number', 'first_name', ...]` | `Message` | Send user vCard contact |
| | `getFile` | `['file_id']` | `File` | Retrieve file info |
| | `downloadFile` | `($file, $saveTo)` | `string` | Download file to disk |
| **Chat Management** | `getChat` | `['chat_id']` | `ChatFullInfo` | Get chat details |
| | `getChatAdministrators` | `['chat_id']` | `ChatMember[]` | List chat administrators |
| | `getChatMembersCount` | `['chat_id']` | `int` | Get total chat member count |
| | `getChatMember` | `['chat_id', 'user_id']` | `ChatMember` | Get specific member info |
| | `banChatMember` | `['chat_id', 'user_id']` | `bool` | Ban user from chat |
| | `unbanChatMember` | `['chat_id', 'user_id']` | `bool` | Unban user in chat |
| | `promoteChatMember` | `['chat_id', 'user_id', ...]` | `bool` | Promote member to admin |
| | `leaveChat` | `['chat_id']` | `bool` | Leave group or channel |
| | `setChatTitle` | `['chat_id', 'title']` | `bool` | Change chat title |
| | `setChatDescription` | `['chat_id', 'description']` | `bool` | Change chat description |
| | `setChatPhoto` | `['chat_id', 'photo']` | `bool` | Set new chat profile photo |
| | `deleteChatPhoto` | `['chat_id']` | `bool` | Delete chat profile photo |
| | `pinChatMessage` | `['chat_id', 'message_id', ...]` | `bool` | Pin message in chat |
| | `unpinChatMessage` | `['chat_id', 'message_id']` | `bool` | Unpin message in chat |
| | `unpinAllChatMessages` | `['chat_id']` | `bool` | Unpin all messages |
| | `createChatInviteLink` | `['chat_id', 'expire_date'?, ...]` | `string` | Create custom invite link |
| | `revokeChatInviteLink` | `['chat_id', 'invite_link']` | `string` | Revoke invite link |
| | `exportChatInviteLink` | `['chat_id']` | `string` | Export primary invite link |
| **Interactions** | `answerCallbackQuery` | `['callback_query_id', 'text'?, ...]` | `bool` | Respond to inline button click |
| **In-App Payments** | `sendInvoice` | `['chat_id', 'title', 'prices', ...]` | `Message` | Send payment invoice |
| | `createInvoiceLink` | `['title', 'prices', 'provider_token', ...]` | `string` | Generate invoice payment link |
| | `answerPreCheckoutQuery` | `['pre_checkout_query_id', 'ok', ...]` | `bool` | Approve/reject checkout |
| | `inquireTransaction` | `['payment_charge_id']` | `Transaction` | Check payment transaction state |
| **Bot Commands** | `setMyCommands` | `['commands']` | `bool` | Set bot commands list |
| | `getMyCommands` | `[]` | `BotCommand[]` | Retrieve registered bot commands |
| | `deleteMyCommands` | `[]` | `bool` | Delete registered bot commands |
| **Stickers** | `sendSticker` | `['chat_id', 'sticker']` | `Message` | Send sticker |
| | `uploadStickerFile` | `['user_id', 'sticker', 'sticker_format']`| `File` | Upload sticker file |
| | `createNewStickerSet` | `['user_id', 'name', 'title', 'stickers', ...]` | `bool` | Create custom sticker set |
| | `addStickerToSet` | `['user_id', 'name', 'sticker']` | `bool` | Add sticker to existing set |

---

## ❓ Frequently Asked Questions (FAQ) / سوالات متداول

<details>
<summary><b>1. How do I get a Bale Bot API Token? / چگونه توکن ربات بله دریافت کنم؟</b></summary>
<br>

To create a bot and get an API token:
1. Open the [Bale Messenger](https://bale.ai/) app.
2. Search for the official **`@BotFather`** account and start a conversation.
3. Send the command `/newbot` and follow the on-screen instructions to select a display name and a unique username ending with `bot`.
4. BotFather will provide an authorization token formatted like `123456789:ABCdefGhIJKlmNoPQRsTUVwxyZ`.
5. Set this token in your `.env` file as `BALE_BOT_TOKEN=your_token_here`.
</details>

<details>
<summary><b>2. How to build a Bale bot in Laravel? / چگونه در لاراول ربات بله بسازیم؟</b></summary>
<br>

Install the package via Composer and publish the configuration:
```bash
composer require erfanvahabpour/bale-bot-sdk
php artisan bale:install
```
Add your bot token to `.env`:
```env
BALE_BOT_TOKEN=123456789:ABCdef...
```
You can now use the `Bale` Facade anywhere in your Laravel application (Controllers, Jobs, Commands, or Routes):
```php
use EFive\Bale\Laravel\Facades\Bale;

Bale::sendMessage([
    'chat_id' => $chatId,
    'text'    => 'سلام! ربات بله لاراول شما با موفقیت راه‌اندازی شد 🚀',
]);
```
</details>

<details>
<summary><b>3. Webhook vs Long-Polling: Which update mechanism should I use? / تفاوت وب‌هوک (Webhook) و پولینگ (Polling) چیست؟</b></summary>
<br>

- **Webhook (Recommended for Production)**: Bale servers push updates to your secure HTTPS webhook URL via POST requests in real time. It is high-performance, asynchronous, and scalable:
  ```bash
  php artisan bale:webhook --set --url=https://your-domain.com/bale/webhook
  ```
- **Long-Polling (Ideal for Local Development & Testing)**: Your application polls Bale servers periodically for new messages. No public domain, static IP, or SSL certificate is required. Run:
  ```bash
  php artisan bale:polling
  ```
</details>

<details>
<summary><b>4. How to create Inline Keyboards (Glass Buttons) with callback queries? / نحوه ساخت دکمه شیشه‌ای (Inline Keyboard) در ربات بله چیست؟</b></summary>
<br>

Inline keyboards are attached directly under messages. You can pass URLs, callback data, or mini-app WebApp triggers:
```php
$inlineKeyboard = [
    'inline_keyboard' => [
        [
            ['text' => '🌐 مشاهده وب‌سایت', 'url' => 'https://github.com/ErfanVahabpour/Bale-Bot-SDK'],
            ['text' => '⚡ تأیید درخواست', 'callback_data' => 'confirm_action'],
        ],
        [
            ['text' => '📱 باز کردن مینی‌اپ', 'web_app' => ['url' => 'https://app.example.com']],
        ]
    ]
];

Bale::sendMessage([
    'chat_id'      => $chatId,
    'text'         => 'لطفاً یکی از گزینه‌های زیر را انتخاب کنید:',
    'reply_markup' => json_encode($inlineKeyboard),
]);
```
Handle button clicks in your webhook or controller by inspecting `$update->getCallbackQuery()`, and acknowledge them using `Bale::answerCallbackQuery(['callback_query_id' => $id])`.
</details>

<details>
<summary><b>5. How does Bale In-App Payment work? / پرداخت و فاکتور درون‌برنامه‌ای بله چگونه کار می‌کند؟</b></summary>
<br>

Bale provides a native in-app payment system. You can send a structured invoice card or create a direct invoice link:
```php
Bale::sendInvoice([
    'chat_id'        => $chatId,
    'title'          => 'اشتراک ویژه یک‌ماهه',
    'description'    => 'دسترسی نامحدود به تمامی خدمات ربات',
    'payload'        => 'order_invoice_id_1002',
    'provider_token' => env('BALE_PAYMENT_PROVIDER_TOKEN'),
    'currency'       => 'IRR',
    'prices'         => [
        ['label' => 'اشتراک ویژه', 'amount' => 500000] // 500,000 Rials
    ],
]);
```
When the user clicks pay, respond to the `pre_checkout_query` update, and verify completion using `Bale::inquireTransaction(['payment_charge_id' => $chargeId])`.
</details>

<details>
<summary><b>6. Can I manage multiple Bale bots in a single Laravel codebase? / آیا امکان مدیریت چندین بات بله به طور هم‌زمان وجود دارد؟</b></summary>
<br>

Yes, Multi-Bot management is supported out of the box! Register extra bot tokens in `config/bale.php`:
```php
'bots' => [
    'default'     => ['token' => env('BALE_BOT_TOKEN')],
    'support_bot' => ['token' => env('BALE_SUPPORT_BOT_TOKEN')],
    'sales_bot'   => ['token' => env('BALE_SALES_BOT_TOKEN')],
],
```
Switch between bots seamlessly in your code:
```php
// Dispatch message via support bot
Bale::bot('support_bot')->sendMessage([
    'chat_id' => $userId,
    'text'    => 'سلام، کارشناس پشتیبانی در خدمت شماست.',
]);

// Dispatch message via main default bot
Bale::sendMessage([
    'chat_id' => $userId,
    'text'    => 'پیام از ربات اصلی.',
]);
```
</details>

---

## 🧪 Testing

Run the automated test suite using PHPUnit:

```bash
composer test
# or directly via PHPUnit
./vendor/bin/phpunit
```

---

## 🤝 Contributing

Contributions are welcome and greatly appreciated!

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Ensure all tests pass (`composer test`)
5. Push to your branch (`git push origin feature/amazing-feature`)
6. Open a Pull Request

---

## 💖 Funding & Support

If this SDK helps you build awesome Bale bots, please consider supporting its ongoing maintenance and development:

- 👤 **Author**: [Erfan Vahabpour](https://erfanvahabpour.ir/)
- 📧 **Email**: [info@efive.net](mailto:info@efive.net)
- 🌐 **Website**: [efive.net](https://efive.net)
- ☕ **Donate**: [Aqayepardakht (آقای پرداخت)](https://aqayepardakht.ir/efive)

---

## 📄 License & Disclaimer

- **License**: Released under the [BSD 4-Clause License](LICENSE.md).
- **Disclaimer**: This project is an unofficial community library and is not officially affiliated with, maintained, or endorsed by Bale.

## Keywords

- کتابخانه بله
- کتابخانه بله PHP
- کتابخانه بله لاراول
- کتابخانه PHP بله
- کتابخانه Laravel بله
- ربات بله PHP
- ربات بله Laravel
- Bale Bot PHP
- Bale Bot Laravel
- Bale PHP SDK
- Bale Laravel SDK
