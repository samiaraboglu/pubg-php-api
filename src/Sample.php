<?php

namespace Pubg;

use \Pubg\Api;
use \Pubg\Object\Sample as SampleObject;

Class Sample
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
     * Populate sample
     *
     * @param array $data
     *
     * @return SampleObject
     */
    public function populate(array $data): SampleObject
    {
        $sample = new SampleObject();

        $sample->setId($data['id']);
        $sample->setData($data);

        return $sample;
    }

    /**
     * Get the samples
     *
     * @param string|null $filterCreatedAtStart
     *
     * @return SampleObject
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $filterCreatedAtStart = null): SampleObject
    {
        $path = '/shards/{platform}/samples';

        if ($filterCreatedAtStart) {
            $path .= sprintf('?filter[createdAt-start]=%s', $filterCreatedAtStart);
        }

        $data = $this->api->request($path)['data'];

        return $this->populate($data);
    }
}
