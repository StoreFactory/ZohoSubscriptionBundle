<?php

/**
 * ZohoSubscription Bundle
 *
 * @author Tristan Bessoussa <tristan.bessoussa@gmail.com>
 */

namespace StoreFactory\ZohoSubscriptionBundle\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class DynamicServiceCacheCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->getParameter('zoho_subscription.cache.service') !== null) {
            $container
                ->getDefinition('zoho.api.manager')
                ->addArgument(new Reference($container->getParameter('zoho_subscription.cache.service')))
            ;
        }
    }
}
