<?php

namespace Pubg;

use \Pubg\Api;
use \Pubg\Object\Leaderboard as LeaderboardsObject;

Class Leaderboard
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
     * Populate leaderboard
     *
     * @param array $data
     *
     * @return LeaderboardsObject
     */
    public function populate(array $data): LeaderboardsObject
    {
        $leaderboard = new LeaderboardsObject();

        $leaderboard->setId($data['id']);
        $leaderboard->setData($data);

        return $leaderboard;
    }

    /**
     * Get the leaderboards
     *
     * @param string $seasonId
     * @param string $gameMode
     * @param null|string|integer $pageNumber
     * @return LeaderboardsObject
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $seasonId, string $gameMode, $pageNumber = null): LeaderboardsObject
    {
        $path = sprintf('/shards/{platform}/leaderboards/%s/%s', $seasonId, $gameMode);

        if (!is_null($pageNumber)) {
            $path .= sprintf('?page[number]=%d', $pageNumber);
        }

        $data = $this->api->request($path)['data'];

        return $this->populate($data);
    }
}
