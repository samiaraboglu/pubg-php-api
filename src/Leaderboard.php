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
     * @return Leaderboard
     */
    public function populate($data)
    {
        $leaderboard = new LeaderboardsObject();

        $leaderboard->setId($data['id']);
        $leaderboard->setData($data);

        return $leaderboard;
    }

    /**
     * Get the leaderboards
     *
     * @param string $gameMode
     * @param int $pageNumber
     *
     * @return Leaderboard
     */
    public function get($gameMode, $pageNumber = null)
    {
        $path = sprintf('/shards/{platform}/leaderboards/%s', $gameMode);

        if (!is_null($pageNumber)) {
            $path .= sprintf('?page[number]=%d', $pageNumber);
        }

        $data = $this->api->request($path)['data'];

        return $this->populate($data);
    }
}
