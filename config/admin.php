<?php

return [
    'disabled' => env('ADMIN_DISABLED', false),

    'allowed_emails' => array_values(array_filter(array_map('trim', explode(',', (string) env('ADMIN_ALLOWED_EMAILS', ''))))),
];
