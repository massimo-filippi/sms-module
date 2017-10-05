<?php

namespace MassimoFilippi\SmsModule\Message;

/**
 * Class SmsMessage
 * @package MassimoFilippi\SmsModule\Message
 */
class SmsMessage implements SmsMessageInterface
{
    /**
     * @var string
     */
    protected $to = '';

    /**
     * @var string
     */
    protected $text = '';

    /**
     * @param string $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
}
