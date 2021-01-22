<?php

namespace Pubg;

class Api
{
    const API_URL = 'https://api.pubg.com';

    const TYPE_GET = 'GET';

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var $endpoint
     */
    protected $endpoint;

    /**
     * @var $services
     */
    protected $services;

    /**
     * Constructor
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Set config
     *
     * @param Config $config
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Get config
     *
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * Set endpoint
     *
     * @param string $endpoint
     */
    public function setEndpoint(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * Get endpoint
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Request to Pubg API
     *
     * @param string $path
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $path): array
    {
        $endpoint = str_replace('{platform}', $this->config->getPlatform(), self::API_URL . $path);

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $endpoint, [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->config->getApiKey()),
                'Accept' => 'application/vnd.api+json'
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Populate service
     *
     * @param string $name Service name
     *
     * @return object
     * @throws \Exception
     */
    public function __get(string $name): object
    {
        if (!in_array($name, ['click2'])) {
            $trace = debug_backtrace();
            throw new \Exception(sprintf('Undefined property via __get(): %s in %s on line %u', $name, $trace[0]['file'], $trace[0]['line']));
        }

        if (isset($this->services[$name])) {
            return $this->services[$name];
        }

        $serviceName = sprintf('%s\\%s', __NAMESPACE__, ucfirst($name));

        $this->services[$name] = new $serviceName($this);

        return $this->services[$name];
    }
}
