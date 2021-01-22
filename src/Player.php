<?php

namespace Pubg;

use \Pubg\Api;
use \Pubg\Object\Player as PlayerObject;

Class Player
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
     * Populate player
     *
     * @param array $data
     *
     * @return PlayerObject
     */
    public function populate(array $data): PlayerObject
    {
        $player = new PlayerObject();

        $player->setId($data['id']);
        $player->setName($data['attributes']['name']);
        $player->setData($data);

        return $player;
    }

    /**
     * Get the player
     *
     * @param string $playerName
     *
     * @return PlayerObject
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $playerName): PlayerObject
    {
        if (strpos($playerName, 'account.') !== false) {
            $data = $this->api->request(sprintf('/shards/{platform}/players/%s', $playerName))['data'];
        } else {
            $data = $this->api->request(sprintf('/shards/{platform}/players?filter[playerNames]=%s', $playerName))['data'][0];
        }

        return $this->populate($data);
    }

    /**
     * Get all players
     *
     * @param string $playerNames
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAll(string $playerNames): array
    {
        if (strpos($playerNames[0], 'account.') !== false) {
            $key = 'playerIds';
        } else {
            $key = 'playerNames';
        }

        $data = $this->api->request(sprintf('/shards/{platform}/players?filter[%s]=%s', $key, implode(',', $playerNames)))['data'];

        $players = [];

        foreach ($data as $value) {
            $player = $this->populate($value);

            $players[] = $player;
        }

        return $players;
    }
}
