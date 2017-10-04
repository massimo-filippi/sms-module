<?php

namespace MassimoFilippi\SmsModule\Service;

/**
 * Interface SmsServiceInterface
 * @package MassimoFilippi\SmsModule\Service
 */
interface SmsServiceInterface
{
    /**
     * @param string $to
     * @param string $text
     * @param string $from
     */
    public function sendSMS($to, $text, $from);
}
