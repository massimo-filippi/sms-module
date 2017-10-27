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

    //-------------------------------------------------------------------------

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

    //-------------------------------------------------------------------------

    /**
     * @param MessageInterface $message
     * @param bool $validateNumberBeforeSending
     * @return bool
     */
    public function sendSms(MessageInterface $message, $validateNumberBeforeSending = false)
    {
        try {
            $smsapi = new SMSApi\Api\SmsFactory();
            $smsapi->setClient($this->client);

            if ($validateNumberBeforeSending && !$this->isNumberValid($message->getTo())) {
                return false;
            }

            $actionSend = $smsapi->actionSend();

            // Set the recipient's number in the form 48xxxxxxxxx or xxxxxxxxx.
            $actionSend->setTo($message->getTo());

            // Set the sender's text.
            $actionSend->setText($message->getText());

            // Set the sender's name. Name has to be set in panel first.
            $actionSend->setSender($this->sender);

            // todo: needs work
            $result = $actionSend->execute();

            return true;
        } catch (SMSApi\Exception\SmsapiException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }

    //-------------------------------------------------------------------------

    /**
     * @param $number
     * @return bool
     */
    private function isNumberValid($number)
    {
        if (empty($number)) {
            return false;
        }

        $requestUrl = 'https://api.smsapi.com/hlr.do';
        $requestUrl .= '?username=' . $this->client->getUsername();
        $requestUrl .= '&password=' . $this->client->getPassword();
        $requestUrl .= '&number=' . $number;
        $requestUrl .= '&format=json';

        $responseJson = @file_get_contents($requestUrl);

        if (false === $responseJson) {
            return false;
        }

        $responseArray = @json_decode($responseJson, true);

        if (null === $responseArray) {
            return false;
        }

        return isset($responseArray['status']) && $responseArray['status'] === 'OK';
    }
}
