<?php

namespace App\Tests\Entity;

use App\Entity\Concert;
use App\Entity\ConcertPass;
use App\Entity\Pass;
use PHPUnit\Framework\TestCase;

// Nous définissons une nouvelle classe de test qui étend la classe TestCase de PHPUnit
class ConcertPassTest extends TestCase
{
    // Nous définissons une méthode de test pour tester les méthodes getId et setId
    public function testGetAndSetId()
    {
        // Nous créons une nouvelle instance de ConcertPass
        $concertPass = new ConcertPass();

        // Nous vérifions que l'ID est null au départ
        $this->assertNull($concertPass->getId());

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    // Nous définissons une méthode de test pour tester les méthodes getConcert et setConcert
    public function testGetAndSetConcert()
    {
        $concertPass = new ConcertPass();
        $this->assertNull($concertPass->getConcert());

        // Nous créons une nouvelle instance de Concert
        $concert = new Concert();

        // Nous définissons le concert de l'instance ConcertPass
        $concertPass->setConcert($concert);

        // Nous vérifions que le concert récupéré est le même que celui que nous avons défini
        $this->assertSame($concert, $concertPass->getConcert());
    }

    // Nous définissons une méthode de test pour tester les méthodes getPass et setPass
    public function testGetAndSetPass()
    {
        $concertPass = new ConcertPass();
        $this->assertNull($concertPass->getPass());

        // Nous créons une nouvelle instance de Pass
        $pass = new Pass();

        // Nous définissons le pass de l'instance ConcertPass
        $concertPass->setPass($pass);

        // Nous vérifions que le pass récupéré est le même que celui que nous avons défini
        $this->assertSame($pass, $concertPass->getPass());
    }
}