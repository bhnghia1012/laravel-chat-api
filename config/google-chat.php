<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Chat Webhook URL
    |--------------------------------------------------------------------------
    |
    | The incoming webhook URL generated from your Google Chat space.
    | Go to your space → Apps & integrations → Webhooks → Add webhook.
    |
    */

    'webhook_url' => env('GOOGLE_CHAT_WEBHOOK_URL', ''),

];
