<?php

namespace App\Tests\Entity;

use App\Entity\Concert;
use App\Entity\DateConcert;
use App\Entity\Scene;
use App\Entity\Musique;
use PHPUnit\Framework\TestCase;

class ConcertTest extends TestCase
{
    public function testGetAndSetId()
    {
        $concert = new Concert();
        $this->assertNull($concert->getId());

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetNomArtiste()
    {
        $concert = new Concert();
        $this->assertNull($concert->getNomArtiste());

        $concert->setNomArtiste("Artiste Test");
        $this->assertSame("Artiste Test", $concert->getNomArtiste());
    }

    public function testGetAndSetDesignation()
    {
        $concert = new Concert();
        $this->assertNull($concert->getDesignation());

        $concert->setDesignation("Designation Test");
        $this->assertSame("Designation Test", $concert->getDesignation());
    }

    public function testGetAndSetDescription()
    {
        $concert = new Concert();
        $this->assertNull($concert->getDescription());

        $concert->setDescription("Description Test");
        $this->assertSame("Description Test", $concert->getDescription());
    }

    public function testGetAndSetDateConcert()
    {
        $concert = new Concert();
        $this->assertNull($concert->getDateConcert());

        $dateConcert = new DateConcert();
        $concert->setDateConcert($dateConcert);
        $this->assertSame($dateConcert, $concert->getDateConcert());
    }

    public function testGetAndSetScene()
    {
        $concert = new Concert();
        $this->assertNull($concert->getScene());

        $scene = new Scene();
        $concert->setScene($scene);
        $this->assertSame($scene, $concert->getScene());
    }

    public function testGetAndSetMusique()
    {
        $concert = new Concert();
        $this->assertNull($concert->getMusique());

        $musique = new Musique();
        $concert->setMusique($musique);
        $this->assertSame($musique, $concert->getMusique());
    }
}