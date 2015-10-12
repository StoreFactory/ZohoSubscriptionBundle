<?php

namespace StoreFactory\ZohoSubscriptionBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('zoho_subscription');

        $rootNode
            ->children()
                ->arrayNode('api')
                    ->children()
                        ->scalarNode('key')
                            ->isRequired()
                            ->info('The service is not free. You must provide an API Key which can be found on : https://www.zoho.com/subscriptions/')
                        ->end()
                        ->scalarNode('organization_id')
                            ->isRequired()
                            ->info('Organization ID from Zoho Subscription')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('cache')
                    ->children()
                        ->booleanNode('enabled')
                            ->info('If cache is active or not')
                            ->defaultValue(false)
                        ->end()
                        ->scalarNode('service')
                            ->info('Defines the service id of the cache that will be used')
                            ->defaultValue(null)
                        ->end()
                        ->integerNode('ttl')
                            ->info('Defines the TTL of the cache')
                            ->defaultValue(null)
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
