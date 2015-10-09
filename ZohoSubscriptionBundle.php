<?php


/**
 * ZohoSubscriptionBundle
 *
 * @author Tristan Bessoussa <tristan.bessoussa@gmail.com>
 */

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use StoreFactory\ZohoSubscriptionBundle\CompilerPass\DynamicServiceCacheCompilerPass;

class ZohoSubscriptionBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new DynamicServiceCacheCompilerPass());
    }
}
