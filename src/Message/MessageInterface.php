<?php

namespace MassimoFilippi\SmsModule\Message;

/**
 * Interface MessageInterface
 * @package MassimoFilippi\SmsModule\Message
 */
interface MessageInterface
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
