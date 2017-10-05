<?php

namespace MassimoFilippi\SmsModule\Service;

use MassimoFilippi\SmsModule\Message\SmsMessageInterface;

/**
 * Interface SmsServiceInterface
 * @package MassimoFilippi\SmsModule\Service
 */
interface SmsServiceInterface
{
    /**
     * @param SmsMessageInterface $smsMessage
     */
    public function sendSMS(SmsMessageInterface $smsMessage);
}
