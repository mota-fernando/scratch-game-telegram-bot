<?php

class TeleBot
{
    public function handleUpdate($update)
    {
        if (isset($update['message']['text'])) {
            $message = $update['message']['text'];
            $chatId = $update['message']['chat']['id'];

            switch ($message) {
                case '/start':
                    $this->sendWelcomeMessage($chatId);
                    break;
                case 'COMPAR RASPADINHA':
                    $this->sendComparRaspadinhaMessage($chatId);
                    break;
                case 'PRÊMIOS E VALORES':
                    $this->sendPremiosValoresMessage($chatId);
                    break;
                case 'COMO RESGATAR O PRÊMIO':
                    $this->sendComoResgatarMessage($chatId);
                    break;
                default:
                    $this->sendDefaultMessage($chatId);
                    break;
            }
        }
    }

   
}
