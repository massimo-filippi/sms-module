<?php

namespace MassimoFilippi\SmsModule;

return [
    'service_manager' => [
        'factories' => [
            Service\Provider\SMSApi\SmsService::class => Service\Provider\SMSApi\SmsServiceFactory::class,
        ],
    ],
];
