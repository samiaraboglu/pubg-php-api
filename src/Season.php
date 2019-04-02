<?php

namespace Pubg;

use \Pubg\Api;
use \Pubg\Object\Season as SeasonObject;

Class Season
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
     * Populate season
     *
     * @param array $data
     *
     * @return Season
     */
    public function populate($data)
    {
        $season = new SeasonObject();

        $season->setId($data['id']);
        $season->setData($data);

        return $season;
    }

    /**
     * Get the season
     *
     * @param string $accountId
     * @param string $seasonId
     *
     * @return Season
     */
    public function get($accountId, $seasonId)
    {
        $data = $this->api->request(sprintf('/shards/{platform}/players/%s/seasons/%s', $accountId, $seasonId))['data'];

        $data['id'] = $seasonId;

        return $this->populate($data);
    }

    /**
     * Get all seasons
     *
     * @return array
     */
    public function getAll()
    {
        $data = $this->api->request('/shards/{platform}/seasons')['data'];

        $seasons = [];

        foreach ($data as $value) {
            $season = $this->populate($value);

            $seasons[] = $season;
        }

        return $seasons;
    }
}
