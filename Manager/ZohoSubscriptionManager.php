<?php

namespace StoreFactory\ZohoSubscriptionBundle\Manager;

use AddonApi;
use PlanApi;

class ZohoSubscriptionManager
{
    /**
     * @var AddonApi
     */
    protected $addonApi;

    /**
     * @var bool
     */
    protected $cache;

    /**
     * @var PlanApi
     */
    protected $planApi;

    /**
     * @var Client
     */
    protected $redis;

    /**
     * @var int
     */
    protected $ttl;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $organizationId;

    /**
     * @param Client $redis Redis client
     * @param bool   $cache Whether the cache is active or not
     * @param int    $ttl   Time to keep the cache in seconds
     */
    public function __construct(PlanApi $planApi, AddonApi $addonApi, $cache = false, Client $redis = null, $ttl = 3600, $token, $organizationId)
    {
        $this->planApi = $planApi;
        $this->addonApi = $addonApi;
        $this->cache = $cache;
        $this->redis = $redis;
        $this->ttl = $ttl;
        $this->token = $token;
        $this->organizationId = $organizationId;
    }
}
