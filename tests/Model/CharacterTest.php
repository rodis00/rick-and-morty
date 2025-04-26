<?php

namespace App\Tests\Model;

use App\Model\Character;
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{
    public function testShouldCreateCharacter()
    {
        $character = new Character(
            "Rick Sanchez",
            "alive",
            "human",
            "",
            "male",
            "someImageUrl",
            ['episode1', 'episode2']
        );

        $this->assertNotNull($character);
        $this->assertEquals("Rick Sanchez", $character->getName());
        $this->assertEquals("alive", $character->getStatus());
        $this->assertEquals("human", $character->getSpecies());
        $this->assertEquals("", $character->getType());
        $this->assertEquals("male", $character->getGender());
        $this->assertEquals("someImageUrl", $character->getImage());
        $this->assertCount(2, $character->getEpisodes());
        $this->assertSame(['episode1', 'episode2'], $character->getEpisodes());
    }
}
