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
     * @return SeasonObject
     */
    public function populate(array $data): SeasonObject
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
     * @param bool $ranked
     * @return SeasonObject
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $accountId, string $seasonId, $ranked = false): SeasonObject
    {
        $rankedPath = $ranked ? '/ranked' : '';

        $data = $this->api->request(
            sprintf(
                '/shards/{platform}/players/%s/seasons/%s' . $rankedPath,
                $accountId,
                $seasonId
            )
        )['data'];

        $data['id'] = $seasonId;

        return $this->populate($data);
    }

    /**
     * @see https://documentation.pubg.com/en/seasons-endpoint.html#/Season_Stats/get_seasons__seasonId__gameMode__gameMode__players
     * @param array $accountIds
     * @param string $seasonId
     * @param string $gameMode
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return Object\Season[]
     */
    public function getBatch(array $accountIds, string $seasonId, string $gameMode): array
    {
        $accountIdsQuery = '?filter[playerIds]=' . implode(',', $accountIds);

        $data = $this->api->request(
            sprintf(
                '/shards/{platform}/seasons/%s/gameMode/%s/players' . $accountIdsQuery,
                $seasonId,
                $gameMode
            )
        )['data'];

        $seasons = [];

        foreach ($data as $value) {
            $value['id'] = $seasonId;
            $season = $this->populate($value);

            $seasons[] = $season;
        }

        return $seasons;
    }

    /**
     * Get all seasons
     *
     * @return Object\Season[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAll(): array
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
