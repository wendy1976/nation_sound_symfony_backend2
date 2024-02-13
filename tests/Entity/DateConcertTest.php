<?php

namespace App\Tests\Entity;

use App\Entity\Concert; // L'entité Concert que nous allons tester
use App\Entity\DateConcert; // L'entité DateConcert que nous allons tester
use PHPUnit\Framework\TestCase; // La classe de base pour tous les tests unitaires PHPUnit

class DateConcertTest extends TestCase // La classe de test pour l'entité DateConcert
{
    public function testGetAndSetId() // Teste les getters et setters pour l'ID
    {
        $dateConcert = new DateConcert(); // Crée une nouvelle instance de DateConcert
        $this->assertNull($dateConcert->getId()); // Vérifie que l'ID est null au départ

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetDateHeure() // Teste les getters et setters pour la date et l'heure
    {
        $dateConcert = new DateConcert(); // Crée une nouvelle instance de DateConcert
        $this->assertNull($dateConcert->getDateHeure()); // Vérifie que la date et l'heure sont null au départ

        $date = new \DateTime(); // Crée une nouvelle instance de DateTime
        $dateConcert->setDateHeure($date); // Définit la date et l'heure
        $this->assertSame($date, $dateConcert->getDateHeure()); // Vérifie que la date et l'heure ont été correctement définies
    }

    public function testGetAndSetConcert() // Teste les getters et setters pour le concert
    {
        $dateConcert = new DateConcert(); // Crée une nouvelle instance de DateConcert
        $this->assertNull($dateConcert->getConcert()); // Vérifie que le concert est null au départ

        $concert = new Concert(); // Crée une nouvelle instance de Concert
        $dateConcert->setConcert($concert); // Définit le concert
        $this->assertSame($concert, $dateConcert->getConcert()); // Vérifie que le concert a été correctement défini
    }
}

