<?php

namespace App\Service;

use App\Model\Character;

class CharacterService
{

    public function __construct(private EpisodeService $episodeService) {}

    public function getCharactersInfo(array $data): array
    {
        $characters = [];

        foreach ($data as $c) {
            $characters[] = new Character(
                $c['name'],
                $c['status'],
                $c['species'],
                $c['type'],
                $c['gender'],
                $c['image'],
                $this->episodeService->getEpisodes($c['episode'])
            );
        }

        return $characters;
    }
}
