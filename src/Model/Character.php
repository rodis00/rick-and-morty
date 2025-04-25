<?php

namespace App\Model;

class Character
{
    private string $name;
    private string $status;
    private string $species;
    private string $type;
    private string $gender;
    private string $image;
    private array $episodes;

    public function __construct(
        string $name,
        string $status,
        string $species,
        string $type,
        string $gender,
        string $image,
        array $episodes
    ) {
        $this->name = $name;
        $this->status = $status;
        $this->species = $species;
        $this->type = $type;
        $this->gender = $gender;
        $this->image = $image;
        $this->episodes = $episodes;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getSpecies(): string
    {
        return $this->species;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getEpisodes(): array
    {
        return $this->episodes;
    }
}
