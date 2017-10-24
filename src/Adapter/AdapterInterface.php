<?php

namespace MassimoFilippi\SmsModule\Adapter;

use MassimoFilippi\SmsModule\Message\MessageInterface;

/**
 * Interface AdapterInterface
 * @package MassimoFilippi\SmsModule\Adapter
 */
interface AdapterInterface
{
    /**
     * @param MessageInterface $message
     */
    public function sendSms(MessageInterface $message);
}
