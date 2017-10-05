<?php

namespace MassimoFilippi\SmsModule\Service\Factory;

use Interop\Container\ContainerInterface;
use MassimoFilippi\SmsModule\Service\SmsService;
use MassimoFilippi\SmsModule\ServiceProvider\SMSApiProvider;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class SmsServiceFactory
 * @package MassimoFilippi\SmsModule\Service\Factory
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

        if (!isset($config['massimo_filippi']) || !is_array($config['massimo_filippi'])) {
            throw new ServiceNotCreatedException('Missing config: You need to specify "massimo_filippi" array.');
        }

        $configMassimoFilippi = $config['massimo_filippi'];

        if (!isset($configMassimoFilippi['sms_module']) || !is_array($configMassimoFilippi['sms_module'])) {
            throw new ServiceNotCreatedException('Missing config: You need to specify "sms_module" array.');
        }

        $configSmsModule = $configMassimoFilippi['sms_module'];

        if (!isset($configSmsModule['type'])) {
            throw new ServiceNotCreatedException('Missing config: You need to specify "type".');
        }

        $type = $config['massimo_filippi']['sms_module']['type'];

        if (!isset($configSmsModule['params']) || !is_array($configSmsModule['params'])) {
            throw new ServiceNotCreatedException('Missing config: You need to specify "params" array.');
        }

        $params = $configSmsModule['params'];

        switch ($type) {
            case SMSApiProvider::class:

                if (!isset($params['api_username'])) {
                    throw new ServiceNotCreatedException('Missing config: You need to specify "api_username".');
                }

                if (!isset($params['api_password_hash'])) {
                    throw new ServiceNotCreatedException('Missing config: You need to specify "api_password_hash".');
                }

                $apiUsername = $params['api_username'];
                $apiPasswordHash = $params['api_password_hash'];

                $smsServiceProvider = new SMSApiProvider($apiUsername, $apiPasswordHash);

                return new SmsService($smsServiceProvider);

                break;
            default:
                throw new ServiceNotCreatedException('There is no matching SMS service provider.');
        }
    }
}
