<?php

namespace MassimoFilippi\SmsModule\ServiceProvider;

use MassimoFilippi\SmsModule\Exception\RuntimeException;
use MassimoFilippi\SmsModule\Message\SmsMessageInterface;
use SMSApi;

/**
 * Class SMSApiProvider
 * @package MassimoFilippi\SmsModule\ServiceProvider
 */
class SMSApiProvider implements SmsServiceProviderInterface
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
     * @param SmsMessageInterface $smsMessage
     * @return SMSApi\Api\Response\StatusResponse
     */
    public function sendSMS(SmsMessageInterface $smsMessage)
    {
        try {

            $smsapi = new SMSApi\Api\SmsFactory();
            $smsapi->setClient($this->client);

            $actionSend = $smsapi->actionSend();

            // Set the recipient's number in the form 48xxxxxxxxx or xxxxxxxxx.
            $actionSend->setTo($smsMessage->getTo());

            // Set the sender's text.
            $actionSend->setText($smsMessage->getText());

            // Set the sender's name. Name has to be set in panel first.
            $actionSend->setSender($this->sender);

            return $actionSend->execute();

        } catch (SMSApi\Exception\SmsapiException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
