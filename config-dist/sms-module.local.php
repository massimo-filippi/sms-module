<?php

return [
    'massimo_filippi' => [
        'sms_module' => [
            'adapter' => \MassimoFilippi\SmsModule\Adapter\SmsApiCom\SmsApiComAdapter::class,
            'adapter_options' => [
                'api_username' => '---API-USERNAME---',
                'api_password_hash' => '---API-PASSWORD-HASH---', // MD5 hash of password in case of SMSApi
            ],
        ],
    ],
];
