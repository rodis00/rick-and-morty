<?php

namespace App\Model;

class Episode
{
    private string $name;
    private string $airDate;
    private string $episode;

    public function __construct(
        string $name,
        string $airDate,
        string $episode
    ) {
        $this->name = $name;
        $this->airDate = $airDate;
        $this->episode = $episode;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAirDate(): string
    {
        return $this->airDate;
    }

    public function getEpisode(): string
    {
        return $this->episode;
    }
}
