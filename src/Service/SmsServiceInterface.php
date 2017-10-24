<?php

namespace MassimoFilippi\SmsModule\Service;

use MassimoFilippi\SmsModule\Message\MessageInterface;

/**
 * Interface SmsServiceInterface
 * @package MassimoFilippi\SmsModule\Service
 */
interface SmsServiceInterface
{
    /**
     * @param MessageInterface $smsMessage
     */
    public function sendSMS(MessageInterface $smsMessage);
}
