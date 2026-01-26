<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    public function send(string $text): void
    {
        $token = (string) env('TELEGRAM_BOT_TOKEN', '');
        $chatId = (string) env('TELEGRAM_CHAT_ID', '');

        if ($token === '' || $chatId === '') {
            return;
        }

        try {
            Http::asForm()
                ->timeout(5)
                ->retry(2, 200)
                ->post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $text,
                    'parse_mode' => 'HTML',
                ]);
        } catch (\Throwable $e) {
            return;
        }
    }
}
