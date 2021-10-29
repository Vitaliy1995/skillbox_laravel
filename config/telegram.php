<?php

return [
    'api' => [
        'host' => 'https://api.telegram.org/',
        'botUri' => 'bot' . env('TELEGRAM_KEY'),
        'methods' => [
            'sendMessage' => [
                'endPoint' => '/sendMessage'
            ],
        ]
    ],
    'chatId' => 277642153
];
