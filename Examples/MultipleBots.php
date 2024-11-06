<?php

require "../vendor/autoload.php";

use EFive\Bale\BotsManager;

$config = [
    'bots' => [
        'mybot' => [
            'token' => file_exists(".token") ? file_get_contents(".token") : "YOUR_BALE_BOT_TOKEN",
        ],
    ]
];

$bale = new BotsManager($config);

$response = $bale->bot('mybot')->getMe();

var_dump($response);