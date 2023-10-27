<?php

namespace App;

use GuzzleHttp\Client;

class FastForexApi
{
    private string $apiKey;
    private string $apiUrl;

    public function __construct()
    {
        $this->apiKey = '';
        $this->apiUrl = "https://api.fastforex.io/convert";
    }

    public function fetchData(string $baseCurrency, string $exchangeCurrency, int $amount)
    {
        $url = "{$this->apiUrl}?from={$baseCurrency}&to={$exchangeCurrency}&amount={$amount}&api_key={$this->apiKey}";
        $client = new Client();

        $response = $client->get($url);
        $responseBody = $response->getBody()->getContents();

        return json_decode($responseBody, true);
    }
}