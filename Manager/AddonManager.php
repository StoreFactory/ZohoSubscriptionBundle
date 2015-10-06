<?php

namespace AppBundle\Manager;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

use AppBundle\ZohoSubscription\Addon\AddonApi;

class AddonManager extends DefaultManager
{
    /**
     * @throws \Exception
     *
     * @return Response
     */
    public function listAllAddons($type = null)
    {
        // Si le cache est présent et actif
        if ($this->redis && true === $this->cache) {
            // Si les résultats sont déjà dans le cache
            if ($this->redis->exists('addons')) {
                return unserialize($this->redis->get('addons'));
            } else {
                // Sinon on les stockes
                $addons = $this->getAllAddons($type);

                $this->redis->setex('addons', $this->ttl, serialize($addons));

                return $addons;
            }
        }

        return $this->getAllAddons($type);
    }

    /**
     * @throws \Exception
     *
     * @return Response
     */
    public function getAllAddons($type = null)
    {
        $addonApi = new AddonApi();
        $addons   = $addonApi->listAllAddons($type)['addons'];

        $addons = array_filter($addons, function ($element) {
            return $element['status'] == 'active';
        });

        return $addons;
    }
}
