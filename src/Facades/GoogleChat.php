<?php

namespace Kun\LaravelChatApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool sendMessage(string $message)
 * @method static bool sendCard(string $title, string $body)
 * @method static bool sendAlert(string $title, string $message, string $level = 'ERROR')
 * @method static \Kun\LaravelChatApi\GoogleChatService to(string $webhookUrl)
 *
 * @see \Kun\LaravelChatApi\GoogleChatService
 */
class GoogleChat extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'google-chat';
    }
}
