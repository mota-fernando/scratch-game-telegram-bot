<?php

require_once dirname(__DIR__). '/vendor/autoload.php';
require_once dirname(__DIR__). '/config/telegram_config.php';

use App\Bot\TeleBot;

$telegramBotApiKey = $config['api_key'];
$teleBot = new TeleBot($telegramBotApiKey);

$data = file_get_contents('php://input');
$update = json_decode($data, true);

$logFile = "webhookdatareceived.json";
$log = fopen($logFile, "a");
fwrite($log, $data);
fclose($log);

if ($update)
    $teleBot->handleUpdate($update);