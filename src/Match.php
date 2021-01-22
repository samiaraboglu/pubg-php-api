<?php

namespace Pubg;

use \Pubg\Api;
use \Pubg\Object\Match as MatchObject;

Class Match
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
     * Populate match
     *
     * @param array $data
     *
     * @return MatchObject
     */
    public function populate(array $data): MatchObject
    {
        $match = new MatchObject();

        $match->setId($data['id']);
        $match->setData($data);

        return $match;
    }

    /**
     * Get the match
     *
     * @param string $matchId
     *
     * @return MatchObject
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $matchId): MatchObject
    {
        $data = $this->api->request(sprintf('/shards/{platform}/matches/%s', $matchId));

        $data['id'] = $matchId;

        return $this->populate($data);
    }
}
