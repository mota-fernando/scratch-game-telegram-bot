<?php


namespace App\Bot;

class TeleBot
{

    protected $telegramBotApiKey;
    protected $telegramApiUrl;

    public function __construct($botToken)
    {
       $this->telegramApiUrl = "https://api.telegram.org/bot$botToken/sendMessage?";
    }

    public function handleUpdate($update)
    {
        if (isset($update['message']['text'])) {
            $message = $update['message'];
            $text = $message['text'];
            $chatId = $message['chat']['id'];
            $first_name = $message['chat']['first_name'];

            switch ($text) {
                case '/start':
                    $this->sendWelcomeMessage($chatId, $first_name);
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

    private function sendWelcomeMessage($chatId, $first_name)
    {
        $replyMarkup = [
            'keyboard' => [
                [['text' => 'COMPAR RASPADINHA']],
                [['text' => 'PRÊMIOS E VALORES']],
                [['text' => 'COMO RESGATAR O PRÊMIO']]
            ],
            'resize_keyboard' => true,
        ];

        $queryParams = [
            'chat_id' => $chatId,
            'text'=> "Bem-vindo $first_name ao Bot da Raspadinha! Esolha uma opção",
            'reply_markup' => json_encode($replyMarkup)
        ];

        $this->sendMessage($queryParams);

    }

    private function sendComparRaspadinhaMessage($chatId)
    {
        $queryParams = [
            'chat_id' => $chatId,
            'text' => 'Aqui você pode comparar as raspadinhas disponíveis.',
        ];

        $this->sendMessage($queryParams);
    }

    private function sendPremiosValoresMessage($chatId)
    {
        $queryParams = [
            'chat_id' => $chatId,
            'text' => 'Aqui você pode ver os prêmios e valores das raspadinhas.',
        ];

        $this->sendMessage($queryParams);
    }

    private function sendComoResgatarMessage($chatId)
    {
        $queryParams = [
            'chat_id' => $chatId,
            'text' => 'Aqui você pode aprender como resgatar seu prêmio.',
        ];

        $this->sendMessage($queryParams);
    }

    private function sendDefaultMessage($chatId)
    {
        $queryParams = [
            'chat_id' => $chatId,
            'text' => 'Desculpe, não entendi sua mensagem. Escolha uma das opções do menu.',
        ];

        $this->sendMessage($queryParams);
    }

    private function sendMessage ($queryParams)
    {
        $response = file_get_contents($this->telegramApiUrl . http_build_query($queryParams));
    }
}
