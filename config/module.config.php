<?php

namespace MassimoFilippi\SmsModule;

return [
    'service_manager' => [
        'factories' => [
            // services
            Service\SmsService::class => Service\Factory\SmsServiceFactory::class,

            // adapters
            Adapter\SmsApiCom\SmsApiComAdapter::class => Adapter\SmsApiCom\Factory\SmsApiComAdapterFactory::class,
        ],
    ],
];
