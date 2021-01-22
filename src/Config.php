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
    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
    /**
     * Get apiKey
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Set platform
     *
     * @param string $platform
     */
    public function setPlatform(string $platform)
    {
        $this->platform = $platform;
    }
    /**
     * Get platform
     *
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }
}
