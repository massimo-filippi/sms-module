<?php

namespace MassimoFilippi\SmsModule\Service\Provider\SMSApi;

use MassimoFilippi\SmsModule\Service\Exception\RuntimeException;
use MassimoFilippi\SmsModule\Service\SmsServiceInterface;
use SMSApi;

/**
 * Class SmsService
 * @package MassimoFilippi\SmsModule\Service\Provider\SMSApi
 * @link https://github.com/smsapicom/smsapicom-php-client
 */
class SmsService implements SmsServiceInterface
{

    /**
     * @var SMSApi\Client
     */
    private $client;

    /**
     * SmsService constructor.
     * @param SMSApi\Client $client
     */
    public function __construct(SMSApi\Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $to
     * @param string $text
     * @param string $sender
     * @return SMSApi\Api\Response\StatusResponse
     */
    public function sendSMS($to, $text, $sender = 'Info')
    {
        try {

            $smsapi = new SMSApi\Api\SmsFactory();
            $smsapi->setClient($this->client);

            $actionSend = $smsapi->actionSend();

            // Set the recipient's number in the form 48xxxxxxxxx or xxxxxxxxx.
            $actionSend->setTo((string)$to);

            // Set the sender's text.
            $actionSend->setText((string)$text);

            // Set the sender's name. Name has to be set in panel first.
            $actionSend->setSender((string)$sender);

            return $actionSend->execute();

        } catch (SMSApi\Exception\SmsapiException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
