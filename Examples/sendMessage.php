<?php

require "../vendor/autoload.php";

use EFive\Bale\Api;

$token = file_exists(".token") ? file_get_contents(".token") : "YOUR_BALE_BOT_TOKEN";

$Bale = new Api($token);

$response = $Bale->sendMessage([
    'chat_id' => '2100855301',
    'text' => 'This is a text.',
    'reply_markup' => [
        'inline_keyboard' => [ 
            [
                [
                    'text' => 'Button',
                    'url' => 'https://bale-bot-sdk.efive.net/'
                ]
            ]
        ]
    ]
]);

var_dump($response);
