<?php

namespace App\Tests\Entity;

use App\Entity\Concert;
use App\Entity\DateConcert;
use PHPUnit\Framework\TestCase;

class DateConcertTest extends TestCase
{
    public function testGetAndSetId()
    {
        $dateConcert = new DateConcert();
        $this->assertNull($dateConcert->getId());

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetDateHeure()
    {
        $dateConcert = new DateConcert();
        $this->assertNull($dateConcert->getDateHeure());

        $date = new \DateTime();
        $dateConcert->setDateHeure($date);
        $this->assertSame($date, $dateConcert->getDateHeure());
    }

    public function testGetAndSetConcert()
    {
        $dateConcert = new DateConcert();
        $this->assertNull($dateConcert->getConcert());

        $concert = new Concert();
        $dateConcert->setConcert($concert);
        $this->assertSame($concert, $dateConcert->getConcert());
    }
}
