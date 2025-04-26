<?php

namespace App\Tests\Model;

use App\Model\Episode;
use PHPUnit\Framework\TestCase;

class EpisodeTest extends TestCase
{
    public function testShouldCreateEpisode()
    {
        $episode = new Episode(
            "Pilot",
            "December 2, 2013",
            "S01E01"
        );

        $this->assertNotNull($episode);
        $this->assertEquals("Pilot", $episode->getName());
        $this->assertEquals("December 2, 2013", $episode->getAirDate());
        $this->assertEquals("S01E01", $episode->getEpisode());
    }
}
