<?php

namespace StoreFactory\ZohoSubscriptionBundle\Manager;

use AppBundle\ZohoSubscription\Addon\AddonApi;
use AppBundle\ZohoSubscription\Plan\PlanApi;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class PlanManager extends DefaultManager
{
    /**
     * @throws \Exception
     *
     * @return Response
     */
    public function listAllPlans()
    {
        // Si le cache est pr�sent et actif
        if ($this->redis && true === $this->cache) {
            // Si les r�sultats sont d�j� dans le cache
            if ($this->redis->exists('plans')) {
                return unserialize($this->redis->get('plans'));
            } else {
                // Sinon on les stockes
                $plans = $this->getAllPlans();

                $this->redis->setex('plans', $this->ttl, serialize($plans));

                return $plans;
            }
        }

        return $this->getAllPlans();
    }

    /**
     * @throws \Exception
     *
     * @return Response
     */
    public function getAllPlans()
    {
        // Sinon on les stockes
        $planApi  = new PlanApi();
        $addonApi = new AddonApi();
        $plans    = $planApi->listAllPlans()['plans'];

        $plans = array_filter($plans, function ($element) {
            return $element['status'] == 'active';
        });

        /*foreach ($plans as &$plan) {
            $recurringAddons = [];

            foreach ($plan['addons'] as $planAddon) {
                $addon = $addonApi->getAddon($planAddon['addon_code'])['addon'];

                if ($addon['type'] == 'recurring') {
                    $recurringAddons[] = $addon;
                }
            }

            $plan['addons'] = $recurringAddons;
        }*/

        return $plans;
    }
}
