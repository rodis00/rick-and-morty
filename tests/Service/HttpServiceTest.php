<?php

namespace App\Tests\Service;

use App\Service\HttpService;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpServiceTest extends TestCase
{
    public function testShouldReturnCharactersPage()
    {
        $expectedData = [
            "results" => [
                [
                    "id" => 1,
                    "name" => "Rick Sanchez",
                    "status" => "Alive",
                    "species" => "Human",
                    "type" => "",
                    "gender" => "Male",
                    "episode" => [
                        "episode1",
                        "episode2"
                    ]
                ]
            ]
        ];

        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->method('toArray')->willReturn($expectedData);

        $clientMock = $this->createMock(HttpClientInterface::class);
        $clientMock->method('request')->willReturn($responseMock);

        /** @var HttpClientInterface&\PHPUnit\Framework\MockObject\MockObject $clientMock */
        $httpService = new HttpService($clientMock);
        $result = $httpService->getCharacterPage(1);

        $this->assertEquals($expectedData, $result);
    }

    public function testShouldReturnListOfEpisodes()
    {
        $expectedData = [
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

        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->method('toArray')->willReturn($expectedData);

        /** @var HttpClientInterface&\PHPUnit\Framework\MockObject\MockObject $clientMock */
        $clientMock = $this->createMock(HttpClientInterface::class);
        $clientMock->method('request')->willReturn($responseMock);

        $httpService = new HttpService($clientMock);
        $result = $httpService->getListOfEpisodes([1, 2]);

        $this->assertEquals($expectedData, $result);
    }
}
