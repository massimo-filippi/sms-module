<?php

namespace MassimoFilippi\SmsModule\Adapter\SmsApiCom\Factory;

use Interop\Container\ContainerInterface;
use MassimoFilippi\SmsModule\Adapter\SmsApiCom\SmsApiComAdapter;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class SmsApiComAdapterFactory
 * @package MassimoFilippi\SmsModule\Adapter\SmsApiCom\Factory
 */
class SmsApiComAdapterFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return SmsApiComAdapter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        /** @var array $config */
        $config = $container->get('Config');

        if (false === isset($config['massimo_filippi']['sms_module']['adapter_options']['api_username'])) {
            throw new ServiceNotCreatedException('Missing adapter parameter: "api_username".');
        }

        if (false === isset($config['massimo_filippi']['sms_module']['adapter_options']['api_password_hash'])) {
            throw new ServiceNotCreatedException('Missing adapter parameter: "api_password_hash".');
        }

        $apiUsername = $config['massimo_filippi']['sms_module']['adapter_options']['api_username'];
        $apiPasswordHash = $config['massimo_filippi']['sms_module']['adapter_options']['api_password_hash'];

        return new SmsApiComAdapter($apiUsername, $apiPasswordHash);
    }
}
