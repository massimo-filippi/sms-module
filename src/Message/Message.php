<?php

namespace MassimoFilippi\SmsModule\Message;

/**
 * Class Message
 * @package MassimoFilippi\SmsModule\Message
 */
class Message implements MessageInterface
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
        $this->to = (string)$to;
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
        $this->text = (string)$text;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
}
