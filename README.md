Bale Bot API - PHP SDK (🚧under development🚧)
==========================

> Bale Bot PHP SDK lets you develop Bale Bots in PHP easily! Supports Laravel out of the box.
>
> [Bale Bot API](https://dev.bale.ai/) is an HTTP-based interface created for developers keen on building bots for Bale.
> 
> To learn more about the Bale Bot API, please consult the [Introduction to Bots](https://dev.bale.ai/) and [Bot FAQ](https://docs.bale.ai/) on official Bale site.
>
> To get started writing your bots using this SDK, Please refer the [documentation](https://bale-bot-sdk.efive.net/).

## Documentation

Documentation for the SDK can be found on the [website](https://bale-bot-sdk.efive.net/).

## Disclaimer

This project and its author are neither associated nor affiliated with [Bale](https://bale.ai/) in any way. 
Please see the [License](https://github.com/ErfanVahabpour/Bale-Bot-SDK/blob/main/LICENSE.md) for more details.

## License

This project is released under the [BSD 4-Clause](https://github.com/ErfanVahabpour/Bale-Bot-SDK/blob/main/LICENSE.md) License.

## Examples

### getMe Method
<p>A simple method for testing your bot's auth token.
<br>
Returns basic information about the bot in form of a User object.
</p>

```php
$Bale = new Api($token);

$response = $Bale->getMe();
```

### sendMessage Method
<p>Send text messages.</p>

```php
$Bale = new Api($token);

$response = $Bale->sendMessage([
    'chat_id' => '2100855301',
    'text' => 'This is a text.'
]);
```

### sendMessage Method in Laravel
<p>Send text messages.</p>

```php
use EFive\Balle\Laravel\Facades\Telegram;

$response = Telegram::sendMessage([
    'chat_id' => '2100855301',
    'text' => 'This is a text.'
]);
```

### Get first name of a chat
<p>Show the first name of a chat(private chats only)</p>

```php
$Bale = new Api($token);

$response = $Bale->getChat([
    'chat_id' => '2100855301'
]);

echo $response->getFirstName();
```

### Setting multiple bots
<P>For setting multiple bots in a single application</P>

```php
use EFive\Bale\BotsManager;

$config = [
    'bots' => [
        'firstBot' => [
            'token' => $firstBotToken,
        ],
        'secondBot' => [
            'token' => $secondBotToken,
        ],
    ]
];

$bale = new BotsManager($config);

// getMe Method
$response = $bale->bot('firstBot')->getMe();
```
