<?php

namespace StoreFactory\ZohoSubscriptionBundle\Manager;

class DefaultManager
{
    /**
     * @var bool
     */
    protected $cache;

    /**
     * @var Client
     */
    protected $redis;

    /**
     * @var int
     */
    protected $ttl;

    /**
     * @param Client $redis Redis client
     * @param bool   $cache Whether the cache is active or not
     * @param int            $ttl        Time to keep the cache in seconds
     */
    public function __construct($cache = false, Client $redis = null, $ttl = 3600)
    {
        $this->cache = $cache;
        $this->redis = $redis;
        $this->ttl = $ttl;
    }
}
