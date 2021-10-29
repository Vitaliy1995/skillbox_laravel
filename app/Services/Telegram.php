<?php


namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;

class Telegram
{
    private $apiHost;
    private $apiBotUri;
    private $apiMethods;
    private $chatId;

    public function __construct(string $apiHost, string $apiBotUri, array $apiMethods, int $chatId)
    {
        $this->apiHost = $apiHost;
        $this->apiBotUri = $apiBotUri;
        $this->apiMethods = $apiMethods;
        $this->chatId = $chatId;
    }

    public function sendMessage(string $text, int $chatId = null)
    {
        if (empty($this->apiMethods['sendMessage'])) {
            return;
        }

        $client = new Client();

        try {
            return $client->post($this->getRequestUrl($this->apiMethods['sendMessage']['endPoint']), [
                RequestOptions::JSON => [
                    'chat_id' => $chatId ?? $this->chatId,
                    'text' => $text
                ]
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function getRequestUrl(string $endPoint)
    {
        return $this->apiHost . $this->apiBotUri . $endPoint;
    }
}
