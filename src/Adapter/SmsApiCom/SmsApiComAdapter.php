<?php

namespace MassimoFilippi\SmsModule\Adapter\SmsApiCom;

use MassimoFilippi\SmsModule\Adapter\AdapterInterface;
use MassimoFilippi\SmsModule\Exception\RuntimeException;
use MassimoFilippi\SmsModule\Message\MessageInterface;
use SMSApi;

/**
 * Class SmsApiComAdapter
 * @package MassimoFilippi\SmsModule\Adapter\SmsApiCom
 */
class SmsApiComAdapter implements AdapterInterface
{
    /**
     * @var SMSApi\Client
     */
    private $client;

    /**
     * @var string
     */
    private $sender = 'Info';

    /**
     * SMSApiProvider constructor.
     * @param string $apiUsername
     * @param string $apiPasswordHash
     * @param null|string $sender
     */
    public function __construct($apiUsername, $apiPasswordHash, $sender = null)
    {
        $this->client = new SMSApi\Client($apiUsername);
        $this->client->setPasswordHash($apiPasswordHash);

        if ($sender) {
            $this->sender = $sender;
        }
    }

    /**
     * @param MessageInterface $message
     * @return SMSApi\Api\Response\StatusResponse
     */
    public function sendSms(MessageInterface $message)
    {
        try {
            $smsapi = new SMSApi\Api\SmsFactory();
            $smsapi->setClient($this->client);

            $actionSend = $smsapi->actionSend();

            // Set the recipient's number in the form 48xxxxxxxxx or xxxxxxxxx.
            $actionSend->setTo($message->getTo());

            // Set the sender's text.
            $actionSend->setText($message->getText());

            // Set the sender's name. Name has to be set in panel first.
            $actionSend->setSender($this->sender);

            return $actionSend->execute();

        } catch (SMSApi\Exception\SmsapiException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
