<?php

namespace App\Tests\Entity;

use App\Entity\Concert; // L'entité Concert que nous allons tester
use App\Entity\Musique; // L'entité Musique que nous allons tester
use PHPUnit\Framework\TestCase; // La classe de base pour tous les tests unitaires PHPUnit

class MusiqueTest extends TestCase // La classe de test pour l'entité Musique
{
    public function testGetAndSetId() // Teste les getters et setters pour l'ID
    {
        $musique = new Musique(); // Crée une nouvelle instance de Musique
        $this->assertNull($musique->getId()); // Vérifie que l'ID est null au départ

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetStyleMusique() // Teste les getters et setters pour le style de musique
    {
        $musique = new Musique(); // Crée une nouvelle instance de Musique
        $this->assertNull($musique->getStyleMusique()); // Vérifie que le style de musique est null au départ

        $musique->setStyleMusique("Style Test"); // Définit le style de musique
        $this->assertSame("Style Test", $musique->getStyleMusique()); // Vérifie que le style de musique a été correctement défini
    }

    public function testGetAndSetConcerts() // Teste les getters et setters pour les concerts
    {
        $musique = new Musique(); // Crée une nouvelle instance de Musique
        $this->assertCount(0, $musique->getConcerts()); // Vérifie que la collection de concerts est vide au départ

        $concert = new Concert(); // Crée une nouvelle instance de Concert
        $musique->addConcert($concert); // Ajoute un concert à la collection
        $this->assertCount(1, $musique->getConcerts()); // Vérifie que la collection de concerts contient maintenant un élément
        $this->assertSame($concert, $musique->getConcerts()[0]); // Vérifie que le concert ajouté est bien dans la collection

        $musique->removeConcert($concert); // Supprime le concert de la collection
        $this->assertCount(0, $musique->getConcerts()); // Vérifie que la collection de concerts est à nouveau vide
    }
}
