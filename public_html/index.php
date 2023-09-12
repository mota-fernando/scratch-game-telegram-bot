<?php

require_once dirname(__DIR__). '/vendor/autoload.php';

use App\Bot\TelegramBot;

$telegram = new TelegramBot();

$update = json_decode(file_get_contents('php://input'), true);

if (!$update) {    
    http_response_code(200);
    echo 'OK';

} else 
    $telegram->sendMessage($update);

  

