<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpService
{
    public function __construct(private HttpClientInterface $client) {}
    private string $BASE_URL = "https://rickandmortyapi.com/api/character/?page=";

    public function getCharacterPage(int $pageNumber): array
    {
        $response = $this->client->request(
            'GET',
            $this->BASE_URL . $pageNumber
        );

        return $response->toArray();
    }

    public function getListOfEpisodes(array $ids)
    {
        $response = $this->client->request(
            'GET',
            'https://rickandmortyapi.com/api/episode/' . implode(',', $ids)
        );

        return $response->toArray();
    }
}
