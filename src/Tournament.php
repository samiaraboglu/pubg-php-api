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
     * @return Tournament
     */
    public function populate($data)
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
     * @return Tournament
     */
    public function get($id)
    {
        $data = $this->api->request(sprintf('/tournaments/%s', $id))['data'];

        return $this->populate($data);
    }

    /**
     * Get all tournaments
     *
     * @return array
     */
    public function getAll()
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
