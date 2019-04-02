<?php

namespace Pubg;

Class Config
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $platform;

    /**
     * Set apiKey
     *
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }
    /**
     * Get apiKey
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set platform
     *
     * @param string $platform
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }
    /**
     * Get platform
     *
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }
}
