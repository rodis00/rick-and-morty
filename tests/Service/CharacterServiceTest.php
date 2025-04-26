<?php

namespace App\Tests\Service;

use App\Model\Character;
use App\Model\Episode;
use App\Service\CharacterService;
use App\Service\EpisodeService;
use PHPUnit\Framework\TestCase;

class CharacterServiceTest extends TestCase
{
    public function testShouldReturnCharactersInfo()
    {

        $data = [
            [
                'name' => 'Rick Sanchez',
                'status' => 'alive',
                'species' => 'human',
                'type' => '',
                'gender' => 'male',
                'image' => 'someImageUrl',
                'episode' => [
                    'https://rickandmortyapi.com/api/episode/1',
                    'https://rickandmortyapi.com/api/episode/2'
                ]
            ],
            [
                'name' => 'Morty Smith',
                'status' => 'alive',
                'species' => 'human',
                'type' => '',
                'gender' => 'male',
                'image' => 'someImageUrl',
                'episode' => [
                    'https://rickandmortyapi.com/api/episode/1',
                    'https://rickandmortyapi.com/api/episode/2'
                ]
            ]
        ];

        $expectedEpisodes = [
            new Episode('Pilot', 'December 2, 2013', 'S01E01'),
            new Episode('Lawnmower Dog', 'December 9, 2013', 'S01E02')
        ];

        /** @var EpisodeService&\PHPUnit\Framework\MockObject\MockObject $episodeServiceMock */
        $episodeServiceMock = $this->createMock(EpisodeService::class);
        $episodeServiceMock->method('getEpisodes')->willReturn($expectedEpisodes);

        $characterService = new CharacterService($episodeServiceMock);
        $result = $characterService->getCharactersInfo($data);

        $this->assertCount(2, $result);
        $this->assertInstanceOf(Character::class, $result[0]);
        $this->assertEquals("Morty Smith", $result[1]->getName());
        $this->assertSame($expectedEpisodes, $result[0]->getEpisodes());
        $this->assertInstanceOf(Episode::class, $result[0]->getEpisodes()[0]);
    }
}
