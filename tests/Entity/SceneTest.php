<?php

namespace App\Tests\Entity;

use App\Entity\Scene; // L'entité Scene que nous allons tester
use App\Entity\Concert; // L'entité Concert que nous allons tester
use PHPUnit\Framework\TestCase; // La classe de base pour tous les tests unitaires PHPUnit

class SceneTest extends TestCase // La classe de test pour l'entité Scene
{
    public function testGetAndSetId() // Teste les getters et setters pour l'ID
    {
        $scene = new Scene(); // Crée une nouvelle instance de Scene
        $this->assertNull($scene->getId()); // Vérifie que l'ID est null au départ

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetNomScene() // Teste les getters et setters pour le nom de la scène
    {
        $scene = new Scene(); // Crée une nouvelle instance de Scene
        $this->assertNull($scene->getNomScene()); // Vérifie que le nom de la scène est null au départ

        $scene->setNomScene("Nom Scene Test"); // Définit le nom de la scène
        $this->assertSame("Nom Scene Test", $scene->getNomScene()); // Vérifie que le nom de la scène a été correctement défini
    }

    public function testGetAndSetConcerts() // Teste les getters et setters pour les concerts
    {
        $scene = new Scene(); // Crée une nouvelle instance de Scene
        $this->assertCount(0, $scene->getConcerts()); // Vérifie que la collection de concerts est vide au départ

        $concert = new Concert(); // Crée une nouvelle instance de Concert
        $scene->addConcert($concert); // Ajoute un concert à la collection
        $this->assertCount(1, $scene->getConcerts()); // Vérifie que la collection de concerts contient maintenant un élément
        $this->assertSame($concert, $scene->getConcerts()[0]); // Vérifie que le concert ajouté est bien dans la collection

        $scene->removeConcert($concert); // Supprime le concert de la collection
        $this->assertCount(0, $scene->getConcerts()); // Vérifie que la collection de concerts est à nouveau vide
    }
}
