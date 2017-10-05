<?php

namespace MassimoFilippi\SmsModule;

return [
    'service_manager' => [
        'factories' => [
            Service\SmsService::class => Service\Factory\SmsServiceFactory::class,
        ],
    ],
];
