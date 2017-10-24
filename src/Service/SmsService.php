<?php

namespace MassimoFilippi\SmsModule\Service;

use MassimoFilippi\SmsModule\Adapter\AdapterInterface;
use MassimoFilippi\SmsModule\Message\MessageInterface;

/**
 * Class SmsService
 * @package MassimoFilippi\SmsModule\Service
 */
class SmsService implements SmsServiceInterface
{
    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * SmsService constructor.
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param MessageInterface $smsMessage
     */
    public function sendSMS(MessageInterface $smsMessage)
    {
        return $this->adapter->sendSMS($smsMessage);
    }
}
