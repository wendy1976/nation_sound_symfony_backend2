<?php

namespace App\Tests\Entity;

use App\Entity\Pass;
use App\Entity\ConcertPass;
use PHPUnit\Framework\TestCase;

class PassTest extends TestCase
{
    public function testGetAndSetId()
    {
        $pass = new Pass();
        $this->assertNull($pass->getId());

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetNomPass()
    {
        $pass = new Pass();
        $this->assertNull($pass->getNomPass());

        $pass->setNomPass("Nom Pass Test");
        $this->assertSame("Nom Pass Test", $pass->getNomPass());
    }

    public function testGetAndSetDescriptionPass()
    {
        $pass = new Pass();
        $this->assertNull($pass->getDescriptionPass());

        $pass->setDescriptionPass("Description Pass Test");
        $this->assertSame("Description Pass Test", $pass->getDescriptionPass());
    }

    public function testGetAndSetPrixPass()
    {
        $pass = new Pass();
        $this->assertNull($pass->getPrixPass());

        $pass->setPrixPass("99.99");
        $this->assertSame("99.99", $pass->getPrixPass());
    }

    public function testGetAndSetImagePath()
    {
        $pass = new Pass();
        $this->assertNull($pass->getImagePath());

        $pass->setImagePath("image/path/test.jpg");
        $this->assertSame("image/path/test.jpg", $pass->getImagePath());
    }

    public function testGetAndSetConcertPasses()
    {
        $pass = new Pass();
        $this->assertCount(0, $pass->getConcertPasses());

        $concertPass = new ConcertPass();
        $pass->addConcertPass($concertPass);
        $this->assertCount(1, $pass->getConcertPasses());
        $this->assertSame($concertPass, $pass->getConcertPasses()[0]);

        $pass->removeConcertPass($concertPass);
        $this->assertCount(0, $pass->getConcertPasses());
    }
}
