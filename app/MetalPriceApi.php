<?php

namespace App;

use GuzzleHttp\Client;

class MetalPriceApi
{
    private string $apiKey;
    private string $apiUrl;

    public function __construct()
    {
        $this->apiKey = '';
        $this->apiUrl = "https://api.metalpriceapi.com/v1/convert";
    }

    public function fetchData(string $baseCurrency, string $exchangeCurrency, int $amount)
    {
        $url = "{$this->apiUrl}?api_key={$this->apiKey}&from={$baseCurrency}&to={$exchangeCurrency}&amount={$amount}";
        $client = new Client();

        $response = $client->get($url);
        $responseBody = $response->getBody()->getContents();

        return json_decode($responseBody, true);
    }
}