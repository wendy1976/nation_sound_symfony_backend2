<?php

namespace App\Tests\Entity;

use App\Entity\Scene;
use App\Entity\Concert;
use PHPUnit\Framework\TestCase;

class SceneTest extends TestCase
{
    public function testGetAndSetId()
    {
        $scene = new Scene();
        $this->assertNull($scene->getId());

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetNomScene()
    {
        $scene = new Scene();
        $this->assertNull($scene->getNomScene());

        $scene->setNomScene("Nom Scene Test");
        $this->assertSame("Nom Scene Test", $scene->getNomScene());
    }

    public function testGetAndSetConcerts()
    {
        $scene = new Scene();
        $this->assertCount(0, $scene->getConcerts());

        $concert = new Concert();
        $scene->addConcert($concert);
        $this->assertCount(1, $scene->getConcerts());
        $this->assertSame($concert, $scene->getConcerts()[0]);

        $scene->removeConcert($concert);
        $this->assertCount(0, $scene->getConcerts());
    }
}
