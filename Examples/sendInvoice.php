<?php

require "../vendor/autoload.php";

use EFive\Bale\Api;

$token = file_exists(".token") ? file_get_contents(".token") : "YOUR_BALE_BOT_TOKEN";

$Bale = new Api($token);

$response = $Bale->sendInvoice([
    'chat_id' => '2100855301',
    'title' => 'This is a title',
    'description' => 'This is a description.',
    'payload' => '2412424124253',
    'provider_token' => '5029381038311346',
    'prices' => [
        [
            'label' => 'First Product',
            'amount' => '140000'
        ]
    ]
]);

var_dump($response);
