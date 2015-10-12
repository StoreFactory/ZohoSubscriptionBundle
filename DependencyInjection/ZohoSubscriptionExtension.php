<?php

namespace StoreFactory\ZohoSubscriptionBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ZohoSubscriptionExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);
        $loader        = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.xml');

        $container->setParameter('zoho_subscription.api_key', $config['api']['key']);
        $container->setParameter('zoho_subscription.org_id', $config['api']['organization_id']);
        $container->setParameter('zoho_subscription.cache.service', $config['cache']['service']);
        $container->setParameter('zoho_subscription.cache.enabled', $config['cache']['enabled']);
        $container->setParameter('zoho_subscription.cache.ttl', $config['cache']['ttl']);
    }
}
