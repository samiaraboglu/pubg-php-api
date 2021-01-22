<?php

namespace Pubg;

use \Pubg\Api;
use \Pubg\Object\Lifetime as LifetimeObject;

Class Lifetime
{
    /**
     * @var Api
     */
    protected $api;

    /**
     * Constructor
     *
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * Populate lifetime
     *
     * @param array $data
     *
     * @return LifetimeObject
     */
    public function populate(array $data): LifetimeObject
    {
        $lifetime = new LifetimeObject();

        $lifetime->setData($data);

        return $lifetime;
    }

    /**
     * Get the lifetime
     *
     * @param string $accountId
     *
     * @return LifetimeObject
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $accountId): LifetimeObject
    {
        $data = $this->api->request(sprintf('/shards/{platform}/players/%s/seasons/lifetime', $accountId))['data'];

        return $this->populate($data);
    }
}
