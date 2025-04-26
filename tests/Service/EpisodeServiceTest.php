<?php

namespace App\Tests\Service;

use App\Model\Episode;
use App\Service\EpisodeService;
use App\Service\HttpService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

class EpisodeServiceTest extends TestCase
{
    public function testShouldReturnListOfEpisodes()
    {

        $expected = [
            [
                "id" => 1,
                "name" => "Pilot",
                "air_date" => "December 2, 2013",
                "episode" => "S01E01"
            ],
            [
                "id" => 2,
                "name" => "Lawnmower Dog",
                "air_date" => "December 9, 2013",
                "episode" => "S01E02"
            ]
        ];

        /** @var HttpService&\PHPUnit\Framework\MockObject\MockObject $httpServiceMock */
        $httpServiceMock = $this->createMock(HttpService::class);
        $httpServiceMock->method('getListOfEpisodes')->willReturn($expected);

        $episodeService = new EpisodeService($httpServiceMock);
        $result = $episodeService->getListOfEpisodes([1, 2]);

        $this->assertCount(2, $result);
        $this->assertSame($expected, $result);
    }

    public function testShouldReturnEpisodes()
    {
        $data = [
            [
                "id" => 1,
                "name" => "Pilot",
                "air_date" => "December 2, 2013",
                "episode" => "S01E01"
            ],
            [
                "id" => 2,
                "name" => "Lawnmower Dog",
                "air_date" => "December 9, 2013",
                "episode" => "S01E02"
            ]
        ];

        /** @var HttpService&\PHPUnit\Framework\MockObject\MockObject $httServiceMock */
        $httServiceMock = $this->createMock(HttpService::class);
        $httServiceMock->method('getListOfEpisodes')->willReturn($data);

        $episodeService = new EpisodeService($httServiceMock);
        $result = $episodeService->getEpisodes([
            'https://rickandmortyapi.com/api/episode/1',
            'https://rickandmortyapi.com/api/episode/2'
        ]);

        $this->assertCount(2, $result);
        $this->assertEquals("S01E01", $result[0]->getEpisode());
        $this->assertEquals("S01E02", $result[1]->getEpisode());
        $this->assertInstanceOf(Episode::class, $result[0]);
    }
}
