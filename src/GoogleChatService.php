<?php

namespace Kun\LaravelChatApi;

use Illuminate\Support\Facades\Http;

class GoogleChatService
{
    protected string $webhookUrl;

    public function __construct(?string $webhookUrl = null)
    {
        $this->webhookUrl = $webhookUrl ?? config('google-chat.webhook_url', '');
    }

    /**
     * Send a plain text message to Google Chat.
     */
    public function sendMessage(string $message): bool
    {
        return $this->post(['text' => $message]);
    }

    /**
     * Send a card message with a title and text body.
     */
    public function sendCard(string $title, string $body): bool
    {
        $payload = [
            'cards' => [
                [
                    'header' => ['title' => $title],
                    'sections' => [
                        [
                            'widgets' => [
                                ['textParagraph' => ['text' => $body]],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return $this->post($payload);
    }

    /**
     * Send a formatted error/alert message with a header colour indicator.
     */
    public function sendAlert(string $title, string $message, string $level = 'ERROR'): bool
    {
        $icon = match (strtoupper($level)) {
            'WARNING' => '⚠️',
            'INFO'    => 'ℹ️',
            'SUCCESS' => '✅',
            default   => '🔴',
        };

        return $this->sendMessage("{$icon} *{$level}* — *{$title}*\n{$message}");
    }

    /**
     * Override the webhook URL at runtime.
     */
    public function to(string $webhookUrl): static
    {
        $clone = clone $this;
        $clone->webhookUrl = $webhookUrl;

        return $clone;
    }

    protected function post(array $payload): bool
    {
        if (empty($this->webhookUrl)) {
            throw new \RuntimeException('Google Chat webhook URL is not configured.');
        }

        $response = Http::post($this->webhookUrl, $payload);

        return $response->successful();
    }
}
