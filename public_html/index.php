<?php

require_once dirname(__DIR__). '/vendor/autoload.php';
require_once 'config/telegram_config.php';

use App\Bot\TelegramBot;

$telegramBotApiKey = $config('api_key');
$telegram = new TelegramBot($telegramBotApiKey);

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$update = json_decode(file_get_contents('php://input'), true);

if ($update) {    
    $telegram->handleUserInput($update);
    $telegram->sendMessage();

} else {
    http_response_code(200);
    echo 'OK';
}
  

