<?php

namespace App\Service;

use App\Model\Episode;

class EpisodeService
{
    public function __construct(private HttpService $httpService) {}

    public function getListOfEpisodes(array $ids)
    {
        return $this->httpService->getListOfEpisodes($ids);
    }

    public function getEpisodes(array $links)
    {
        $ids = $this->getIds($links);
        $episodesData = $this->getListOfEpisodes($ids);

        if (isset($episodesData['id'])) {
            $episodesData = [$episodesData];
        }

        $episodes = [];

        foreach ($episodesData as $e) {
            $episodes[] = new Episode(
                $e['name'],
                $e['air_date'],
                $e['episode']
            );
        }

        return $episodes;
    }

    private function getIds($links)
    {
        foreach ($links as $link) {
            $ids[] = substr($link, strlen('https://rickandmortyapi.com/api/episode/'));
        }

        return $ids;
    }
}
