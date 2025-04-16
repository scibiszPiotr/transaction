<?php

namespace App;

use GuzzleHttp\Client;

class HttpClient
{
    public function __construct(private Client $client)
    {
    }

    public function get($uri = '', array $options = []): string
    {
        $response = $this->client->get($uri, $options);

        if ($response->getStatusCode() === 200) {
            return $response->getBody();
        }

        throw new \Exception($response->getBody(), $response->getStatusCode());
    }
}