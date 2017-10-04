<?php

namespace MassimoFilippi\SmsModule\Service\Provider\SMSApi;

use Interop\Container\ContainerInterface;
use SMSApi;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class SmsServiceFactory
 * @package MassimoFilippi\SmsModule\Service\Provider\SMSApi
 */
class SmsServiceFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return SmsService
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        /** @var array $config */
        $config = $container->get('Config');

        if (!isset($config['massimo_filippi'])) {
            throw new ServiceNotCreatedException('Missing config: You need to specify "massimo_filippi" array.');
        }

        if (!isset($config['massimo_filippi']['sms_module'])) {
            throw new ServiceNotCreatedException('Missing config: You need to specify "sms_module" array in "massimo_filippi" array.');
        }

        if (!isset($config['massimo_filippi']['sms_module']['api_username'])) {
            throw new ServiceNotCreatedException('Missing config: You need to specify "api_username" in "sms_module" array.');
        }

        if (!isset($config['massimo_filippi']['sms_module']['api_password'])) {
            throw new ServiceNotCreatedException('Missing config: You need to specify "api_password" in "sms_module" array.');
        }

        $apiUsername = $config['massimo_filippi']['sms_module']['api_username'];
        $apiPassword = $config['massimo_filippi']['sms_module']['api_password'];


        $client = new SMSApi\Client($apiUsername);
        $client->setPasswordHash($apiPassword);

        return new SmsService($client);
    }
}
