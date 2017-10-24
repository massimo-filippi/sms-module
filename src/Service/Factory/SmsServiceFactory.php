<?php

namespace MassimoFilippi\SmsModule\Service\Factory;

use Interop\Container\ContainerInterface;
use MassimoFilippi\SmsModule\Adapter\SmsApiCom\SmsApiComAdapter;
use MassimoFilippi\SmsModule\Service\SmsService;
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

        if (false === isset($config['massimo_filippi']['sms_module'])) {
            throw new ServiceNotCreatedException('Missing configuration for sms module.');
        }

        if (false === isset($config['massimo_filippi']['sms_module']['adapter'])) {
            throw new ServiceNotCreatedException('Missing adapter name.');
        }

        $adapterName = $config['massimo_filippi']['sms_module']['adapter'];

        switch ($adapterName) {
            case SmsApiComAdapter::class:
                $adapter = $container->get(SmsApiComAdapter::class);
                break;
            default:
                throw new ServiceNotCreatedException(sprintf('Adapter "%s" could not be found.', $adapterName));
        }

        return new SmsService($adapter);
    }
}
