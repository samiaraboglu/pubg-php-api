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
     * @return Sample
     */
    public function populate($data)
    {
        $sample = new SampleObject();

        $sample->setId($data['id']);
        $sample->setData($data);

        return $sample;
    }

    /**
     * Get the samples
     *
     * @param string $filterCreatedAtStart
     *
     * @return Sample
     */
    public function get($filterCreatedAtStart = null)
    {
        $path = '/shards/{platform}/samples';

        if ($filterCreatedAtStart) {
            $path .= sprintf('?filter[createdAt-start]=%s', $filterCreatedAtStart);
        }

        $data = $this->api->request($path)['data'];

        return $this->populate($data);
    }
}
