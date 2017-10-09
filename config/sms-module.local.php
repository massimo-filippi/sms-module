<?php

return [
    'massimo_filippi' => [
        'sms_module' => [
            'type' => \MassimoFilippi\SmsModule\ServiceProvider\SMSApiProvider::class, // Type of the provider we want to use.
            'params' => [ // Some params needed to create chosen provider.
                'api_username' => '---API-USERNAME---',
                'api_password_hash' => '---API-PASSWORD-HASH---', // MD5 hash of password in case of SMSApi
            ],
        ],
    ],
];
