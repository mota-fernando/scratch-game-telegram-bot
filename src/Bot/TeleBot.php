<?php

namespace App\Bot;

use TelegramBot\Api;

class TeleBot {

    private $telegram;
    private $message;
    private $text;
    private $chatId;

    public function __construct($botToken){
        $this->telegram = new Api($botToken);
    }

    public function handleUserInput($update){
        $this->message = $update['message'];
        $this->text = $message['text'];
        $this->chatId = $message['chat']['id'];

    }

    private function sendMessage(){        
        if ($this->text === '/start') {
            $this->telegram->sendMessage([
                'chat_id' => $this->chatId,
                'text' => 'Bem-vindo ao bot do Telegram!',
            ]);
        }
    }
}
