<?php

namespace MassimoFilippi\SmsModule\Service;

use MassimoFilippi\SmsModule\Message\SmsMessageInterface;
use MassimoFilippi\SmsModule\ServiceProvider\SmsServiceProviderInterface;

/**
 * Class SmsService
 * @package MassimoFilippi\SmsModule\Service
 */
class SmsService implements SmsServiceInterface
{
    /**
     * @var SmsServiceProviderInterface
     */
    private $smsServiceProvider;

    /**
     * SmsService constructor.
     * @param SmsServiceProviderInterface $smsServiceProvider
     */
    public function __construct(SmsServiceProviderInterface $smsServiceProvider)
    {
        $this->smsServiceProvider = $smsServiceProvider;
    }

    /**
     * @param SmsMessageInterface $smsMessage
     */
    public function sendSMS(SmsMessageInterface $smsMessage)
    {
        return $this->smsServiceProvider->sendSMS($smsMessage);
    }
}
