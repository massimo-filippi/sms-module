<?php

namespace MassimoFilippi\SmsModule\Message;

/**
 * Interface SmsMessageInterface
 * @package MassimoFilippi\SmsModule\Message
 */
interface SmsMessageInterface
{
    /**
     * @param string $to
     */
    public function setTo($to);

    /**
     * @return string
     */
    public function getTo();

    /**
     * @param string $text
     */
    public function setText($text);

    /**
     * @return string
     */
    public function getText();
}
