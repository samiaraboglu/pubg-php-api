<?php

namespace Pubg;

use \Pubg\Api;
use \Pubg\Object\Tournament as TournamentObject;

Class Tournament
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
     * Populate tournament
     *
     * @param array $data
     *
     * @return TournamentObject
     */
    public function populate(array $data): TournamentObject
    {
        $tournament = new TournamentObject();

        $tournament->setId($data['id']);
        $tournament->setData($data);

        return $tournament;
    }

    /**
     * Get the tournament
     *
     * @param string $id
     *
     * @return TournamentObject
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $id): TournamentObject
    {
        $data = $this->api->request(sprintf('/tournaments/%s', $id))['data'];

        return $this->populate($data);
    }

    /**
     * Get all tournaments
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAll(): array
    {
        $data = $this->api->request('/tournaments');

        $tournaments = [];

        foreach ($data['data'] as $value) {
            $tournament = $this->populate($value);

            $tournaments[] = $tournament;
        }

        return $tournaments;
    }
}
