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
     * @param bool $validateNumberBeforeSending
     * @return mixed
     */
    public function sendSMS(MessageInterface $smsMessage, $validateNumberBeforeSending = false);
}
