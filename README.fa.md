<div align="center" dir="rtl">

# 🤖 SDK PHP ربات بله

**کتابخانه مدرن، قدرتمند و غیررسمی پی‌اچ‌پی برای اتصال به [وب‌سرویس بات پیام‌رسان بله (Bale Bot API)](https://docs.bale.ai/).**

[![Tests](https://github.com/ErfanVahabpour/Bale-Bot-SDK/actions/workflows/ci.yml/badge.svg)](https://github.com/ErfanVahabpour/Bale-Bot-SDK/actions/workflows/ci.yml)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/erfanvahabpour/bale-bot-sdk.svg?style=flat-square&color=blue)](https://packagist.org/packages/erfanvahabpour/bale-bot-sdk)
[![PHP Version](https://img.shields.io/badge/PHP-%5E8.2-777bb4.svg?style=flat-square&logo=php)](https://php.net)
[![Laravel Support](https://img.shields.io/badge/Laravel-10%20%7C%2011%20%7C%2012%20%7C%2013-FF2D20.svg?style=flat-square&logo=laravel)](https://laravel.com)
[![Software License](https://img.shields.io/badge/license-BSD--4--Clause-green.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/erfanvahabpour/bale-bot-sdk.svg?style=flat-square&color=orange)](https://packagist.org/packages/erfanvahabpour/bale-bot-sdk)

<br />

🌐 **Language / زبان:** [**English**](README.md) | **فارسی (Persian)**

</div>

---

<div dir="rtl">

## 🌟 معرفی و نمای کلی

**Bale Bot PHP SDK** یک پکیج مدرن، شیء‌گرا و توسعه‌پذیر برای زبان PHP است که تعامل با [وب‌سرویس بات‌های پیام‌رسان بله](https://docs.bale.ai/) را بسیار ساده و لذت‌بخش می‌کند. این SDK با ساختار کاملاً تایپ‌شده (Strictly Typed)، پشتیبانی بومی از لاراول، پشتیبانی از مدیریت چند ربات به صورت هم‌زمان، سیستم جامع پردازش دستورات و امکانات پرداخت درون‌برنامه‌ای، تمام نیازهای شما را برای ساخت ربات‌های فروشگاهی، پشتیبانی، خدماتی و سرگرمی پوشش می‌دهد.

---

## ✨ ویژگی‌های کلیدی

- ⚡ **پوشش ۱۰۰ درصدی متدهای وب‌سرویس بله** — پیاده‌سازی کامل تمامی متدهای پیام‌ها، رسانه‌ها، مدیریت چت‌ها، وبهوک، استیکرها و پرداخت‌های بله طبق [مستندات رسمی](https://docs.bale.ai/).
- 🚀 **پشتیبانی درجه‌یک از لاراول (Laravel 10, 11, 12, 13)** — همراه با شناسایی خودکار ServiceProvider، فساد (`Bale::`)، انتشار فایل کانفیگ و دستورات کاربردی Artisan.
- 🤖 **مدیریت هم‌زمان چندین بات (Multi-Bot)** — امکان تعریف و جابجایی بین چندین ربات در یک پروژه بدون تداخل (`Bale::bot('support_bot')`).
- 🎯 **مدیریت آسان وبهوک و پولینگ** — متدهای بهینه برای دریافت و اعتبارسنجی آپدیت‌های ارسالی از سرور بله.
- 💳 **پشتیبانی کامل از پرداخت‌های درون‌برنامه‌ای بله** — ارسال فاکتور، ایجاد لینک پرداخت، تایید پیش‌پرداخت (`pre_checkout_query`) و استعلام تراکنش‌ها.
- 💬 **رابط‌های کاربری تعاملی و مینی‌اپ‌ها** — پشتیبانی از دکمه‌های شیشه‌ای (Inline Keyboard)، دکمه‌های معمولی (Reply Keyboard)، وب‌اپ‌ها / مینی‌اپ‌ها (`WebAppInfo`) و دکمه کپی متن.
- 🧠 **سیستم خط فرمان اختصاصی (Command Bus)** — نوشتن دستورات ماژولار و تمیز با قابلیت دریافت متغیر با عبارات باقاعده (Regex) و تزریق وابستگی (Dependency Injection).
- 🔔 **معماری مبتنی بر رویداد (Event-Driven)** — ارسال ایونت `UpdateWasReceived` با قابلیت اتصال به شنونده‌های لاراول.
- ⚡ **درخواست‌های ناهمگام (Async) و کلاینت دلخواه** — امکان ارسال غیرهمگام ریکوئست‌ها و جایگزینی کلاینت HTTP.
- 🛡️ **مدرن و تست‌شده** — نیازمند PHP 8.2 به بالا با پوشش کامل تست‌های خودکار PHPUnit.

---

## 📖 فهرست مطالب

- [پیش‌نیازها](#-پیشنیازها)
- [نصب و راه‌اندازی](#-نصب-و-راهاندازی)
- [یکپارچه‌سازی با لاراول (Laravel)](#-یکپارچهسازی-با-لاراول-laravel)
  - [۱. انتشار فایل پیکربندی](#۱-انتشار-فایل-پیکربندی)
  - [۲. تنظیم متغیرهای محیطی (.env)](#۲-تنظیم-متغیرهای-محیطی-env)
  - [۳. پیکربندی چند ربات (Multi-Bot)](#۳-پیکربندی-چند-ربات-multi-bot)
  - [۴. دستورات خط فرمان آرتیسان (Artisan CLI)](#۴-دستورات-خط-فرمان-آرتیسان-artisan-cli)
- [شروع سریع](#-شروع-سریع)
  - [در PHP خام (Standalone)](#در-php-خام-standalone)
  - [در فریم‌ورک لاراول (Laravel)](#در-فریمورک-لاراول-laravel)
- [راهنمای جامع استفاده](#-راهنمای-جامع-استفاده)
  - [۱. ارسال و مدیریت پیام‌ها](#۱-ارسال-و-مدیریت-پیامها)
  - [۲. کیبوردهای تعاملی و مینی‌اپ‌ها (Mini-Apps)](#۲-کیبوردهای-تعاملی-و-مینیاپها-mini-apps)
  - [۳. آپلود و ارسال انواع رسانه و فایل](#۳-آپلود-و-ارسال-انواع-رسانه-و-فایل)
  - [۴. وضعیت‌های گفتگو (Chat Actions / در حال تایپ...)](#۴-وضعیتهای-گفتگو-chat-actions--در-حال-تایپ)
  - [۵. مدیریت گروه‌ها، کانال‌ها و دسترسی مدیران](#۵-مدیریت-گروهها-کانالها-و-دسترسی-مدیران)
  - [۶. مدیریت آپدیت‌ها با وبهوک (Webhook) و پولینگ (Polling)](#۶-مدیریت-آپدیتها-با-وبهوک-webhook-و-پولینگ-polling)
  - [۷. سیستم پیشرفته دستورات (Command Bus)](#۷-سیستم-پیشرفته-دستورات-command-bus)
  - [۸. درگاه پرداخت و فاکتور درون‌برنامه‌ای بله](#۸-درگاه-پرداخت-و-فاکتور-درونبرنامهای-بله)
  - [۹. ارسال و ساخت پک استیکر](#۹-ارسال-و-ساخت-پک-استیکر)
  - [۱۰. تنظیم منوی دستورات ربات (Bot Commands Menu)](#۱۰-تنظیم-منوی-دستورات-ربات-bot-commands-menu)
  - [۱۱. سیستم رویدادها و شنونده‌ها (Events & Listeners)](#۱۱-سیستم-رویدادها-و-شنوندهها-events--listeners)
  - [۱۲. مدیریت خطاها و Exceptionها](#۱۲-مدیریت-خطاها-و-exceptionها)
  - [۱۳. تنظیمات پیشرفته و کلاینت سفارشی](#۱۳-تنظیمات-پیشرفته-و-کلاینت-سفارشی)
- [جدول مرجع متدهای API](#-جدول-مرجع-متدهای-api)
- [اجرای تست‌ها](#-اجرای-تستها)
- [مشارکت در توسعه](#-مشارکت-در-توسعه)
- [حمایت مالی و پشتیبانی](#-حمایت-مالی-و-پشتیبانی)
- [مجوز و سلب مسئولیت](#-مجوز-و-سلب-مسئولیت)

---

## 📋 پیش‌نیازها

| پیش‌نیاز | حداقل نسخه | توضیحات |
|---|---|---|
| **PHP** | `>= 8.2` | پشتیبانی کامل از PHP 8.2, 8.3, 8.4+ |
| **Laravel** *(اختیاری)* | `^10.0 \| ^11.0 \| ^12.0 \| ^13.0` | در صورت استفاده در پروژه‌های لاراولی |
| **اکستنشن‌های پی‌اچ‌پی** | `ext-json`, `ext-curl`, `ext-mbstring` | اکستنشن‌های استاندارد و پیش‌فرض PHP |

---

## 📦 نصب و راه‌اندازی

برای نصب پکیج با استفاده از Composer دستور زیر را در ترمینال پروژه خود اجرا کنید:

```bash
composer require erfanvahabpour/bale-bot-sdk
```

---

## 🚀 یکپارچه‌سازی با لاراول (Laravel)

### ۱. انتشار فایل پیکربندی

پکیج به صورت خودکار توسط سیستم Package Discovery لاراول شناسایی می‌شود. برای انتشار فایل تنظیمات دستور زیر را اجرا نمایید:

```bash
php artisan vendor:publish --tag="bale-config"
```

این دستور فایل `config/bale.php` را در پوشه تنظیمات لاراول ایجاد می‌کند.

### ۲. تنظیم متغیرهای محیطی (.env)

توکن ربات خود را در فایل `.env` وارد کنید:

```env
BALE_BOT_TOKEN=123456789:ABCdefGhIJKlmNoPQRsTUVwxyZ
BALE_BOT_NAME=main_bot
BALE_WEBHOOK_URL=https://yourdomain.com/api/bale/webhook
BALE_ASYNC_REQUESTS=false
```

### ۳. پیکربندی چند ربات (Multi-Bot)

در فایل `config/bale.php` می‌توانید یک یا چند بات مختلف را به صورت تفکیک‌شده تنظیم کنید:

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

### ۴. دستورات خط فرمان آرتیسان (Artisan CLI)

مدیریت وبهوک ربات‌ها مستقیماً از طریق خط فرمان لاراول:

```bash
# تنظیم وبهوک برای ربات پیش‌فرض
php artisan bale:webhook --setup

# تنظیم وبهوک برای یک ربات مشخص
php artisan bale:webhook support_bot --setup

# دریافت وضعیت و اطلاعات فعلی وبهوک
php artisan bale:webhook --info

# مشاهده اطلاعات وبهوک تمامی ربات‌های تعریف‌شده
php artisan bale:webhook --info --all

# حذف وبهوک فعال
php artisan bale:webhook --remove
```

---

## 🏁 شروع سریع

### در PHP خام (Standalone)

```php
require_once __DIR__ . '/vendor/autoload.php';

use EFive\Bale\Api;

// ساخت نمونه با توکن ربات
$bale = new Api('YOUR_BOT_TOKEN');

// ۱. دریافت اطلاعات ربات و تست اتصال
$botUser = $bale->getMe();
echo "متصل شد به نام کاربری: @{$botUser->username} (شناسه: {$botUser->id})
";

// ۲. ارسال پیام متنی ساده
$message = $bale->sendMessage([
    'chat_id' => '123456789',
    'text'    => 'سلام از Bale Bot PHP SDK! 🚀',
]);

echo "پیام با شناسه {$message->message_id} ارسال شد.";
```

### در فریم‌ورک لاراول (Laravel)

```php
use EFive\Bale\Laravel\Facades\Bale;

// استفاده از ربات پیش‌فرض تنظیم‌شده در config/bale.php
Bale::sendMessage([
    'chat_id' => '123456789',
    'text'    => 'سلام از لاراول! 🎉',
]);

// یا ارسال از طریق یک ربات دیگر:
Bale::bot('support_bot')->sendMessage([
    'chat_id' => '123456789',
    'text'    => 'پیام واحد پشتیبانی',
]);
```

---

## 💡 راهنمای جامع استفاده

### ۱. ارسال و مدیریت پیام‌ها

#### ارسال پیام ساده و فرمت‌بندی‌شده (HTML / Markdown)
```php
use EFive\Bale\Laravel\Facades\Bale;

$response = Bale::sendMessage([
    'chat_id'                  => '123456789',
    'text'                     => 'متن <b>ضخیم</b>، <i>ایتالیک</i> و <code>کد برنامه</code>!',
    'parse_mode'               => 'HTML', // یا 'Markdown'
    'disable_web_page_preview' => false,
]);
```

#### فوروارد و کپی پیام‌ها
```php
// فوروارد پیام (با نمایش هدر فرستنده اصلی)
Bale::forwardMessage([
    'chat_id'      => 'TARGET_CHAT_ID',
    'from_chat_id' => 'SOURCE_CHAT_ID',
    'message_id'   => 1024,
]);

// کپی پیام (بدون درج هدر فوروارد)
$copiedId = Bale::copyMessage([
    'chat_id'      => 'TARGET_CHAT_ID',
    'from_chat_id' => 'SOURCE_CHAT_ID',
    'message_id'   => 1024,
    'caption'      => 'کپشن دلخواه برای رسانه کپی‌شده',
]);
```

#### ویرایش و حذف پیام‌ها
```php
// ویرایش متن پیام ارسالی
Bale::editMessageText([
    'chat_id'    => '123456789',
    'message_id' => 1024,
    'text'       => 'متن جدید و به‌روزرسانی‌شده پیام.',
]);

// ویرایش کپشن رسانه
Bale::editMessageCaption([
    'chat_id'    => '123456789',
    'message_id' => 1024,
    'caption'    => 'کپشن جدید تصویر.',
]);

// حذف پیام
Bale::deleteMessage([
    'chat_id'    => '123456789',
    'message_id' => 1024,
]);
```

---

### ۲. کیبوردهای تعاملی و مینی‌اپ‌ها (Mini-Apps)

#### دکمه‌های شیشه‌ای (Inline Keyboards)
```php
use EFive\Bale\Laravel\Facades\Bale;

$replyMarkup = [
    'inline_keyboard' => [
        [
            ['text' => '🌐 مشاهده وب‌سایت', 'url' => 'https://bale.ai'],
            ['text' => '🔔 عضویت در خبرنامه', 'callback_data' => 'action_subscribe'],
        ],
        [
            // باز کردن وب‌اپ / مینی‌اپ بله
            ['text' => '📱 اجرای مینی‌اپ', 'web_app' => ['url' => 'https://miniapp.example.com']],
            // دکمه کپی سریع متن
            ['text' => '📋 کپی کد تخفیف', 'copy_text' => ['text' => 'NOROOZ1405']],
        ],
    ],
];

Bale::sendMessage([
    'chat_id'      => '123456789',
    'text'         => 'لطفاً یکی از گزینه‌های زیر را انتخاب نمایید:',
    'reply_markup' => $replyMarkup,
]);
```

#### کیبورد معمولی پایین صفحه (Reply Keyboard)
```php
$replyKeyboard = [
    'keyboard' => [
        [
            ['text' => '📦 مشاهده محصولات'],
            ['text' => '📞 تماس با پشتیبانی'],
        ],
        [
            ['text' => '📍 ارسال موقعیت مکانی', 'request_location' => true],
            ['text' => '📱 اشتراک‌گذاری شماره موبایل', 'request_contact' => true],
        ],
    ],
    'resize_keyboard'   => true,
    'one_time_keyboard' => false,
];

Bale::sendMessage([
    'chat_id'      => '123456789',
    'text'         => 'خوش آمدید! گزینه مورد نظر را انتخاب کنید:',
    'reply_markup' => $replyKeyboard,
]);

// حذف کیبورد پایین صفحه
Bale::sendMessage([
    'chat_id'      => '123456789',
    'text'         => 'منوی کیبورد برداشته شد.',
    'reply_markup' => ['remove_keyboard' => true],
]);
```

---

### ۳. آپلود و ارسال انواع رسانه و فایل

کلاس هلپر `InputFile` امکان ارسال فایل‌ها از حافظه دیسک، آدرس اینترنتی (URL)، رشته‌های خام محتوا یا استریم‌های باز را فراهم می‌کند.

```php
use EFive\Bale\FileUpload\InputFile;
use EFive\Bale\Laravel\Facades\Bale;

// ۱. ارسال تصویر از حافظه محلی
Bale::sendPhoto([
    'chat_id' => '123456789',
    'photo'   => InputFile::file('/path/to/banner.jpg'),
    'caption' => 'پوستر دوره جدید آموزشی 📸',
]);

// ۲. ارسال سند/فایل متنی از متن پویا
Bale::sendDocument([
    'chat_id'  => '123456789',
    'document' => InputFile::createFromContents('محتوای گزارش و صورت‌حساب...', 'report.txt'),
    'caption'  => 'گزارش ماهانه شما',
]);

// ۳. ارسال فایل صوتی و موزیک
Bale::sendAudio([
    'chat_id'   => '123456789',
    'audio'     => InputFile::file('/path/to/podcast.mp3'),
    'title'     => 'پادکست شماره ۴۲',
    'performer' => 'رادیو بله',
]);

// ۴. ارسال ویدیو و انیمیشن GIF
Bale::sendVideo([
    'chat_id' => '123456789',
    'video'   => InputFile::file('/path/to/tutorial.mp4'),
    'caption' => 'ویدیو راهنمای استفاده 🎥',
]);

Bale::sendAnimation([
    'chat_id'   => '123456789',
    'animation' => InputFile::file('/path/to/animation.gif'),
]);

// ۵. ارسال پیام صوتی (Voice)
Bale::sendVoice([
    'chat_id' => '123456789',
    'voice'   => InputFile::file('/path/to/voice.ogg'),
]);

// ۶. ارسال آلبوم رسانه‌ای (Media Group)
Bale::sendMediaGroup([
    'chat_id' => '123456789',
    'media'   => [
        [
            'type'    => 'photo',
            'media'   => InputFile::file('/path/to/image1.jpg'),
            'caption' => 'آلبوم تصاویر شماره ۱',
        ],
        [
            'type'  => 'photo',
            'media' => InputFile::file('/path/to/image2.jpg'),
        ],
    ],
]);
```

#### دانلود فایل‌های دریافتی
```php
// دریافت متادیتا و مسیر دانلود فایل
$file = Bale::getFile(['file_id' => 'FILE_ID_FROM_UPDATE']);
echo "حجم فایل: {$file->file_size} بایت
";

// دانلود و ذخیره فایل بر روی دیسک محلی
$savedPath = Bale::downloadFile($file, storage_path('app/downloads/' . basename($file->file_path)));
```

---

### ۴. وضعیت‌های گفتگو (Chat Actions / در حال تایپ...)

نمایش وضعیت موقت برای بهبود تجربه کاربری در زمان آماده‌سازی پاسخ:

```php
use EFive\Bale\Laravel\Facades\Bale;

// مقادیر مجاز: typing, upload_photo, record_video, upload_video, record_audio, upload_audio, upload_document, find_location
Bale::sendChatAction([
    'chat_id' => '123456789',
    'action'  => 'typing',
]);
```

---

### ۵. مدیریت گروه‌ها، کانال‌ها و دسترسی مدیران

```php
use EFive\Bale\Laravel\Facades\Bale;

$chatId = '-100123456789';

// ۱. دریافت مشخصات چت و تعداد اعضا
$chat = Bale::getChat(['chat_id' => $chatId]);
$membersCount = Bale::getChatMembersCount(['chat_id' => $chatId]);

// ۲. دریافت فهرست مدیران چت
$admins = Bale::getChatAdministrators(['chat_id' => $chatId]);
foreach ($admins as $admin) {
    echo "{$admin->user->first_name} - دسترسی: {$admin->status}
";
}

// ۳. ارتقای کاربر به سطح مدیر با تعیین دسترسی‌ها
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

// ۴. مسدودسازی (Ban) و رفع مسدودسازی کاربر
Bale::banChatMember(['chat_id' => $chatId, 'user_id' => 123456]);
Bale::unbanChatMember(['chat_id' => $chatId, 'user_id' => 123456]);

// ۵. سنجاق کردن (Pin) و برداشتن سنجاق پیام‌ها
Bale::pinChatMessage(['chat_id' => $chatId, 'message_id' => 1024, 'disable_notification' => false]);
Bale::unpinChatMessage(['chat_id' => $chatId, 'message_id' => 1024]);
Bale::unpinAllChatMessages(['chat_id' => $chatId]);

// ۶. ساخت لینک دعوت زمان‌دار با محدودیت تعداد عضویت
$newInvite = Bale::createChatInviteLink([
    'chat_id'      => $chatId,
    'expire_date'  => time() + 86400,
    'member_limit' => 50,
]);
```

---

### ۶. مدیریت آپدیت‌ها با وبهوک (Webhook) و پولینگ (Polling)

#### کنترلر و روت وبهوک در لاراول
یک روت در فایل `routes/api.php` تعریف نمایید:

```php
use Illuminate\Http\Request;
use EFive\Bale\Laravel\Facades\Bale;

Route::post('/bale/webhook', function (Request $request) {
    // تبدیل خودکار بدنه ریکوئست به آبجکت Update
    $update = Bale::getWebhookUpdate();

    // ۱. پردازش پیام‌های متنی دریافتی
    if ($update->isType('message')) {
        $message = $update->message;
        $chatId  = $message->chat->id;
        $text    = $message->text;

        if ($text === '/start') {
            Bale::sendMessage([
                'chat_id' => $chatId,
                'text'    => "سلام {$message->from->first_name} عزیز! به ربات خوش آمدید.",
            ]);
        }
    }

    // ۲. پردازش کلیک روی دکمه‌های شیشه‌ای (Callback Query)
    elseif ($update->isType('callback_query')) {
        $callback = $update->callbackQuery;

        // پاسخ به کلیک برای بستن انیمیشن لودینگ روی دکمه کاربر
        Bale::answerCallbackQuery([
            'callback_query_id' => $callback->id,
            'text'              => 'عملیات با موفقیت انجام شد! ✅',
            'show_alert'        => false,
        ]);
    }

    return response()->json(['ok' => true]);
});
```

#### حالت لانگ پولینگ در محیط خط فرمان
مناسب برای توسعه لوکال یا ورکر‌های CLI:

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
                'text'    => "اکو: " . $update->message->text,
            ]);
        }
    }
    sleep(1);
}
```

---

### ۷. سیستم پیشرفته دستورات (Command Bus)

این SDK مجهز به یک سیستم توزیع دستورات (Command Bus) قدرتمند است که به شما امکان می‌دهد کدهای خود را تمیز، تفکیک‌شده و تست‌پذیر نگه دارید.

#### ساخت یک کلاس دستور سفارشی
کلاسی بسازید که از `EFive\Bale\Commands\Command` ارث‌بری می‌کند:

```php
namespace App\Bale\Commands;

use EFive\Bale\Commands\Command;
use App\Services\UserService;

class StartCommand extends Command
{
    /** @var string نام دستور */
    protected string $name = 'start';

    /** @var string[] نام‌های مستعار دستور */
    protected array $aliases = ['begin', 'welcome'];

    /** @var string توضیحات دستور */
    protected string $description = 'شروع کار و دریافت خوش‌آمدگویی';

    /** @var string الگوی متغیرهای ورودی (مثلا /start {ref}) */
    protected string $pattern = '{ref}';

    // تزریق وابستگی خودکار توسط کانتینر لاراول!
    public function __construct(protected UserService $userService)
    {
    }

    public function handle(): void
    {
        $user = $this->getUpdate()->getMessage()->from;
        $referral = $this->argument('ref', 'هیچ');

        $this->userService->registerOrUpdate($user->id, $user->username);

        // متد هلپر پاسخ (شناسه چت به صورت خودکار پر می‌شود)
        $this->replyWithMessage([
            'text' => "سلام {$user->first_name} عزیز! (کد معرف: {$referral})",
            'reply_markup' => [
                'inline_keyboard' => [
                    [['text' => '🚀 ورود به پنل کاربری', 'callback_data' => 'open_panel']]
                ]
            ]
        ]);
    }
}
```

#### ثبت و اجرای خودکار دستورات
در فایل `config/bale.php`:
```php
'commands' => [
    \App\Bale\Commands\StartCommand::class,
    \EFive\Bale\Commands\HelpCommand::class,
],
```

در روت وبهوک:
```php
Route::post('/bale/webhook', function () {
    // پردازش خودکار دستورات وارد شده توسط کاربر
    Bale::commandsHandler(true);

    return response()->json(['ok' => true]);
});
```

---

### ۸. درگاه پرداخت و فاکتور درون‌برنامه‌ای بله

پیاده‌سازی تراکنش‌های مالی و فروش اشتراک یا محصول درون پیام‌رسان بله از طریق درگاه بانکی بله:

```php
use EFive\Bale\Laravel\Facades\Bale;

// ۱. ارسال فاکتور مستقیم به چت کاربر
Bale::sendInvoice([
    'chat_id'        => '123456789',
    'title'          => 'اشتراک ویژه VIP',
    'description'    => 'دسترسی یک‌ماهه به کانال تحلیل و آموزش',
    'payload'        => 'user_order_88319',
    'provider_token' => 'YOUR_PAYMENT_PROVIDER_TOKEN',
    'prices'         => [
        ['label' => 'مبلغ اشتراک', 'amount' => 500000], // مبلغ به ریال
        ['label' => 'مالیات ارزش افزوده', 'amount' => 45000],
    ],
]);

// ۲. تولید لینک قابل اشتراک‌گذاری پرداخت فاکتور
$paymentUrl = Bale::createInvoiceLink([
    'title'          => 'دانلود کتاب الکترونیکی',
    'description'    => 'فایل کامل راهنما به همراه کد منبع',
    'payload'        => 'ebook_order_102',
    'provider_token' => 'YOUR_PAYMENT_PROVIDER_TOKEN',
    'prices'         => [
        ['label' => 'قیمت نهایی', 'amount' => 150000],
    ],
]);

// ۳. اعتبارسنجی و تایید پیش‌پرداخت در وب‌هوک
if ($update->isType('pre_checkout_query')) {
    $queryId = $update->pre_checkout_query->id;

    // بررسی موجودی محصول یا اعتبار کاربر و تایید سفارش
    Bale::answerPreCheckoutQuery([
        'pre_checkout_query_id' => $queryId,
        'ok'                    => true,
    ]);
}

// ۴. استعلام وضعیت تراکنش انجام‌شده
$transaction = Bale::inquireTransaction([
    'payment_charge_id' => 'chg_sample_id_123',
]);

echo "وضعیت تراکنش: {$transaction->status}
";
```

---

### ۹. ارسال و ساخت پک استیکر

```php
use EFive\Bale\FileUpload\InputFile;
use EFive\Bale\Laravel\Facades\Bale;

// ارسال استیکر با استفاده از file_id
Bale::sendSticker([
    'chat_id' => '123456789',
    'sticker' => 'STICKER_FILE_ID',
]);

// آپلود فایل تصویر برای استیکر
$file = Bale::uploadStickerFile([
    'user_id'        => 123456,
    'sticker'        => InputFile::file('/path/to/sticker.png'),
    'sticker_format' => 'static',
]);

// ساخت بسته استیکر جدید
Bale::createNewStickerSet([
    'user_id'  => 123456,
    'name'     => 'animals_by_mybot',
    'title'    => 'حیوانات دوست‌داشتنی',
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

### ۱۰. تنظیم منوی دستورات ربات (Bot Commands Menu)

تعریف گزینه‌هایی که هنگام فشردن دکمه منو یا کاراکتر `/` در محیط چت بله نمایش داده می‌شوند:

```php
use EFive\Bale\Laravel\Facades\Bale;

// ثبت دستورات منوی ربات
Bale::setMyCommands([
    'commands' => [
        ['command' => 'start', 'description' => 'شروع به کار ربات'],
        ['command' => 'help', 'description' => 'راهنما و دستورات کاربردی'],
        ['command' => 'account', 'description' => 'مدیریت حساب و اشتراک'],
    ],
]);

// دریافت لیست دستورات ثبت‌شده
$commands = Bale::getMyCommands();

// پاکسازی تمام دستورات منو
Bale::deleteMyCommands();
```

---

### ۱۱. سیستم رویدادها و شنونده‌ها (Events & Listeners)

این SDK به ازای هر آپدیت دریافتی رویداد `EFive\Bale\Events\UpdateWasReceived` را صادر می‌کند. در لاراول می‌توانید شنونده‌های دلخواه را در `EventServiceProvider` ثبت کنید:

```php
use EFive\Bale\Events\UpdateWasReceived;
use App\Listeners\LogBaleUpdateListener;

protected $listen = [
    UpdateWasReceived::class => [
        LogBaleUpdateListener::class,
    ],
];
```

کد شنونده:
```php
namespace App\Listeners;

use EFive\Bale\Events\UpdateWasReceived;

class LogBaleUpdateListener
{
    public function handle(UpdateWasReceived $event): void
    {
        $update = $event->update;
        $botApi = $event->bale;

        \Log::info('شناسه آپدیت بله: ' . $update->updateId);
    }
}
```

---

### ۱۲. مدیریت خطاها و Exceptionها

پکیج دارای ساختار خطای استاندارد و شفاف برای جلوگیری از کرش برنامه است:

```php
use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Exceptions\BaleResponseException;
use EFive\Bale\Exceptions\BaleBotNotFoundException;

try {
    $response = Bale::sendMessage([
        'chat_id' => '123456789',
        'text'    => 'پیام تست',
    ]);
} catch (BaleResponseException $e) {
    // خطای بازگشتی از سمت سرور بله
    echo "کد وضعیت HTTP: " . $e->getHttpStatusCode();
    echo "پیام خطا: " . $e->getMessage();
    echo "کد خطا: " . $e->getErrorCode();
    $rawResponse = $e->getRawResponse();
} catch (BaleBotNotFoundException $e) {
    // صدا زدن نام باتی که در کانفیگ تعریف نشده است
    echo "ربات یافت نشد: " . $e->getMessage();
} catch (BaleSDKException $e) {
    // سایر خطاهای داخلی SDK
    echo "خطای SDK: " . $e->getMessage();
}
```

---

### ۱۳. تنظیمات پیشرفته و کلاینت سفارشی

#### ارسال درخواست‌های ناهمگام (Async Requests)
فعال‌سازی از طریق `.env` (`BALE_ASYNC_REQUESTS=true`) یا در زمان نمونه‌سازی:

```php
$bale = new \EFive\Bale\Api('YOUR_TOKEN', async: true);
```

#### آدرس پایه سفارشی / پراکسی (Proxy & Mock API)
برای پروژه‌های تست محلی یا عبور ترافیک از سرور میانی:

```php
$bale = new \EFive\Bale\Api('YOUR_TOKEN', baseBotUrl: 'https://proxy.example.com/bot');
```

#### پیاده‌سازی کلاینت HTTP سفارشی
با پیاده‌سازی اینترفیس `EFive\Bale\HttpClients\HttpClientInterface` می‌توانید کلاینت انتقال ترافیک HTTP دلخواه خود (Guzzle سفارشی، cURL مستقیم یا کلاینت‌های HTTP/2) را تزریق کنید.

---

## 📚 جدول مرجع متدهای API

تمامی متدهای SDK دارای خروجی تایپ‌شده با استفاده از مدل‌های `BaseObject`، آرایه یا بولین هستند:

| دسته‌بندی | نام متد | پارامترها | نوع خروجی | شرح عملکرد |
|---|---|---|---|---|
| **اطلاعات و آپدیت** | `getMe` | `[]` | `User` | دریافت اطلاعات و مشخصات ربات |
| | `getUpdates` | `['offset'?, 'limit'?, 'timeout'?, ...]` | `Update[]` | دریافت آپدیت‌ها در حالت لانگ‌پولینگ |
| | `setWebhook` | `['url', 'certificate'?, 'allowed_updates'?]` | `bool` | تنظیم آدرس وبهوک ربات |
| | `deleteWebhook` / `removeWebhook` | `[]` | `bool` | حذف وبهوک فعال |
| | `getWebhookInfo` | `[]` | `WebhookInfo` | استعلام وضعیت فعلی وبهوک |
| | `getWebhookUpdate` | `[$shouldEmitEvents, $request]` | `Update` | پردازش آبجکت آپدیت ورودی وبهوک |
| **ارسال پیام** | `sendMessage` | `['chat_id', 'text', 'reply_markup'?, ...]` | `Message` | ارسال پیام متنی |
| | `forwardMessage` | `['chat_id', 'from_chat_id', 'message_id']` | `Message` | فوروارد پیام با هدر اصلی |
| | `copyMessage` | `['chat_id', 'from_chat_id', 'message_id', ...]` | `MessageId` | کپی پیام بدون هدر فوروارد |
| | `editMessageText` | `['chat_id', 'message_id', 'text', ...]` | `Message\|bool` | ویرایش متن پیام ارسالی |
| | `editMessageCaption` | `['chat_id', 'message_id', 'caption', ...]` | `Message\|bool` | ویرایش کپشن رسانه |
| | `editMessageReplyMarkup` | `['chat_id', 'message_id', 'reply_markup']` | `Message\|bool` | ویرایش دکمه‌های شیشه‌ای پیام |
| | `deleteMessage` | `['chat_id', 'message_id']` | `bool` | حذف پیام |
| | `sendChatAction` | `['chat_id', 'action']` | `bool` | ارسال وضعیت چت (در حال تایپ و...) |
| | `askReview` | `['chat_id', ...]` | `Message` | ارسال درخواست نظر/امتیاز |
| **ارسال فایل و رسانه** | `sendPhoto` | `['chat_id', 'photo', 'caption'?, ...]` | `Message` | ارسال تصویر |
| | `sendAudio` | `['chat_id', 'audio', 'caption'?, ...]` | `Message` | ارسال فایل صوتی |
| | `sendDocument` | `['chat_id', 'document', 'caption'?, ...]` | `Message` | ارسال سند و فایل عمومی |
| | `sendVideo` | `['chat_id', 'video', 'caption'?, ...]` | `Message` | ارسال ویدیو |
| | `sendAnimation` | `['chat_id', 'animation', 'caption'?, ...]` | `Message` | ارسال گیف و انیمیشن |
| | `sendVoice` | `['chat_id', 'voice', 'caption'?, ...]` | `Message` | ارسال پیام صوتی کوتاه (ویس) |
| | `sendMediaGroup` | `['chat_id', 'media']` | `Message[]` | ارسال آلبوم چندتایی عکس و فیلم |
| | `sendLocation` | `['chat_id', 'latitude', 'longitude']` | `Message` | ارسال لوکیشن روی نقشه |
| | `sendContact` | `['chat_id', 'phone_number', 'first_name', ...]` | `Message` | ارسال مخاطب و شماره تلفن |
| | `getFile` | `['file_id']` | `File` | دریافت مشخصات فایل برای دانلود |
| | `downloadFile` | `($file, $saveTo)` | `string` | دانلود و ذخیره‌سازی فایل روی دیسک |
| **مدیریت چت و گروه** | `getChat` | `['chat_id']` | `ChatFullInfo` | دریافت مشخصات کامل چت/گروه |
| | `getChatAdministrators` | `['chat_id']` | `ChatMember[]` | دریافت لیست مدیران چت |
| | `getChatMembersCount` | `['chat_id']` | `int` | دریافت تعداد اعضای چت |
| | `getChatMember` | `['chat_id', 'user_id']` | `ChatMember` | دریافت وضعیت یک کاربر مشخص در چت |
| | `banChatMember` | `['chat_id', 'user_id']` | `bool` | مسدودسازی و اخراج کاربر از چت |
| | `unbanChatMember` | `['chat_id', 'user_id']` | `bool` | رفع مسدودسازی کاربر |
| | `promoteChatMember` | `['chat_id', 'user_id', ...]` | `bool` | ارتقای کاربر به مدیر چت |
| | `leaveChat` | `['chat_id']` | `bool` | ترک گروه یا کانال توسط ربات |
| | `setChatTitle` | `['chat_id', 'title']` | `bool` | تغییر عنوان گروه یا کانال |
| | `setChatDescription` | `['chat_id', 'description']` | `bool` | تغییر توضیحات بیوگرافی چت |
| | `setChatPhoto` | `['chat_id', 'photo']` | `bool` | تغییر عکس پروفایل گروه یا کانال |
| | `deleteChatPhoto` | `['chat_id']` | `bool` | حذف عکس پروفایل چت |
| | `pinChatMessage` | `['chat_id', 'message_id', ...]` | `bool` | سنجاق کردن پیام |
| | `unpinChatMessage` | `['chat_id', 'message_id']` | `bool` | برداشتن سنجاق پیام |
| | `unpinAllChatMessages` | `['chat_id']` | `bool` | برداشتن سنجاق تمام پیام‌ها |
| | `createChatInviteLink` | `['chat_id', 'expire_date'?, ...]` | `string` | ساخت لینک دعوت سفارشی |
| | `revokeChatInviteLink` | `['chat_id', 'invite_link']` | `string` | باطل کردن لینک دعوت |
| | `exportChatInviteLink` | `['chat_id']` | `string` | دریافت لینک دعوت اصلی چت |
| **تعاملات کاربر** | `answerCallbackQuery` | `['callback_query_id', 'text'?, ...]` | `bool` | پاسخ به کلیک دکمه‌های شیشه‌ای |
| **درگاه پرداخت** | `sendInvoice` | `['chat_id', 'title', 'prices', ...]` | `Message` | ارسال فاکتور پرداخت بانکی |
| | `createInvoiceLink` | `['title', 'prices', 'provider_token', ...]` | `string` | تولید لینک مستقیم پرداخت |
| | `answerPreCheckoutQuery` | `['pre_checkout_query_id', 'ok', ...]` | `bool` | تایید یا رد سفارش قبل از پرداخت |
| | `inquireTransaction` | `['payment_charge_id']` | `Transaction` | استعلام وضعیت پرداخت تراکنش |
| **دستورات منو** | `setMyCommands` | `['commands']` | `bool` | تنظیم دستورات منوی ربات |
| | `getMyCommands` | `[]` | `BotCommand[]` | دریافت لیست دستورات فعال منو |
| | `deleteMyCommands` | `[]` | `bool` | حذف دستورات منوی ربات |
| **استیکرها** | `sendSticker` | `['chat_id', 'sticker']` | `Message` | ارسال استیکر |
| | `uploadStickerFile` | `['user_id', 'sticker', 'sticker_format']`| `File` | آپلود فایل اولیه استیکر |
| | `createNewStickerSet` | `['user_id', 'name', 'title', 'stickers', ...]` | `bool` | ساخت بسته استیکر جدید |
| | `addStickerToSet` | `['user_id', 'name', 'sticker']` | `bool` | افزودن استیکر به بسته موجود |

---

## 🧪 اجرای تست‌ها

برای اجرای آزمون‌های اتوماتیک PHPUnit دستور زیر را اجرا کنید:

```bash
composer test
# یا مستقیماً از طریق فایل اجرایی PHPUnit
./vendor/bin/phpunit
```

---

## 🤝 مشارکت در توسعه

از تمامی مشارکت‌ها، گزارش باگ‌ها و ارسال Pull Requestها با کمال میل استقبال می‌شود!

۱. مخزن پروژه را Fork کنید.
۲. یک برنچ جدید برای قابلیت خود بسازید (`git checkout -b feature/amazing-feature`).
۳. تغییرات خود را کامیت کنید (`git commit -m 'Add some amazing feature'`).
۴. مطمئن شوید تمام تست‌ها پاس می‌شوند (`composer test`).
۵. برنچ خود را Push کنید (`git push origin feature/amazing-feature`).
۶. یک Pull Request باز کنید.

---

## 💖 حمایت مالی و پشتیبانی

اگر این پکیج برای شما کاربردی و مفید بوده است، با حمایت مالی به تداوم و توسعه بیشتر آن کمک کنید:

- 👤 **توسعه‌دهنده**: [عرفان وهاب‌پور](https://erfanvahabpour.ir/)
- 📧 **ایمیل**: [info@efive.net](mailto:info@efive.net)
- 🌐 **وب‌سایت**: [efive.net](https://efive.net)
- ☕ **دونیت و حمایت مالی**: [آقای پرداخت (Aqayepardakht)](https://aqayepardakht.ir/efive)

---

## 📄 مجوز و سلب مسئولیت

- **مجوز نرم‌افزار**: منتشر شده تحت مجوز [BSD 4-Clause License](LICENSE.md).
- **سلب مسئولیت**: این پروژه یک پکیج غیررسمی توسعه‌داده‌شده توسط جامعه کاربری است و هیچ‌گونه وابستگی یا تاییدیه رسمی از سوی پیام‌رسان بله ندارد.

</div>
