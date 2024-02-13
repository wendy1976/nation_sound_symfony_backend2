<?php

namespace App\Tests\Entity;

use App\Entity\Concert;
use App\Entity\Musique;
use PHPUnit\Framework\TestCase;

class MusiqueTest extends TestCase
{
    public function testGetAndSetId()
    {
        $musique = new Musique();
        $this->assertNull($musique->getId());

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetStyleMusique()
    {
        $musique = new Musique();
        $this->assertNull($musique->getStyleMusique());

        $musique->setStyleMusique("Style Test");
        $this->assertSame("Style Test", $musique->getStyleMusique());
    }

    public function testGetAndSetConcerts()
    {
        $musique = new Musique();
        $this->assertCount(0, $musique->getConcerts());

        $concert = new Concert();
        $musique->addConcert($concert);
        $this->assertCount(1, $musique->getConcerts());
        $this->assertSame($concert, $musique->getConcerts()[0]);

        $musique->removeConcert($concert);
        $this->assertCount(0, $musique->getConcerts());
    }
}
