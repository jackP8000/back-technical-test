<?php

namespace App\Service;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class LocationService
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function isValidAddress(string $address){
        $response = $this->client->request('GET', 'https://api-adresse.data.gouv.fr/search/', [
            'query' => [
                'q' => $address
            ]
        ]);

        $result = json_decode($response->getContent());

        foreach($result->features as $feature){
            if ($feature->properties->score > 0.6){
                return true;
            }
        }

        return false;
    }
}
