<?php

namespace App;

use GuzzleHttp\Client;

class FxRatesApi
{
    private string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = "https://api.fxratesapi.com/convert";
    }

    public function fetchData($baseCurrency, $exchangeCurrency, $amount)
    {
        $url = "{$this->apiUrl}?from={$baseCurrency}&to={$exchangeCurrency}&amount={$amount}&format=json";
        $client = new Client();

        $response = $client->request('GET', $url);
        return json_decode($response->getBody(), true);
    }
}
