<?php

require "../vendor/autoload.php";

use EFive\Bale\Api;

$token = file_exists(".token") ? file_get_contents(".token") : "YOUR_BALE_BOT_TOKEN";

$Bale = new Api($token);

$response = $Bale->getChat([
    'chat_id' => '2100855301'
]);

var_dump($response);

