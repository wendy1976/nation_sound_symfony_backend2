<?php

namespace App\Tests\Entity;

use App\Entity\Pass; // L'entité Pass que nous allons tester
use App\Entity\ConcertPass; // L'entité ConcertPass que nous allons tester
use PHPUnit\Framework\TestCase; // La classe de base pour tous les tests unitaires PHPUnit

class PassTest extends TestCase // La classe de test pour l'entité Pass
{
    public function testGetAndSetId() // Teste les getters et setters pour l'ID
    {
        $pass = new Pass(); // Crée une nouvelle instance de Pass
        $this->assertNull($pass->getId()); // Vérifie que l'ID est null au départ

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetNomPass() // Teste les getters et setters pour le nom du pass
    {
        $pass = new Pass(); // Crée une nouvelle instance de Pass
        $this->assertNull($pass->getNomPass()); // Vérifie que le nom du pass est null au départ

        $pass->setNomPass("Nom Pass Test"); // Définit le nom du pass
        $this->assertSame("Nom Pass Test", $pass->getNomPass()); // Vérifie que le nom du pass a été correctement défini
    }

    public function testGetAndSetDescriptionPass() // Teste les getters et setters pour la description du pass
    {
        $pass = new Pass(); // Crée une nouvelle instance de Pass
        $this->assertNull($pass->getDescriptionPass()); // Vérifie que la description du pass est null au départ

        $pass->setDescriptionPass("Description Pass Test"); // Définit la description du pass
        $this->assertSame("Description Pass Test", $pass->getDescriptionPass()); // Vérifie que la description du pass a été correctement définie
    }

    public function testGetAndSetPrixPass() // Teste les getters et setters pour le prix du pass
    {
        $pass = new Pass(); // Crée une nouvelle instance de Pass
        $this->assertNull($pass->getPrixPass()); // Vérifie que le prix du pass est null au départ

        $pass->setPrixPass("99.99"); // Définit le prix du pass
        $this->assertSame("99.99", $pass->getPrixPass()); // Vérifie que le prix du pass a été correctement défini
    }

    public function testGetAndSetImagePath() // Teste les getters et setters pour le chemin de l'image
    {
        $pass = new Pass(); // Crée une nouvelle instance de Pass
        $this->assertNull($pass->getImagePath()); // Vérifie que le chemin de l'image est null au départ

        $pass->setImagePath("image/path/test.jpg"); // Définit le chemin de l'image
        $this->assertSame("image/path/test.jpg", $pass->getImagePath()); // Vérifie que le chemin de l'image a été correctement défini
    }

    public function testGetAndSetConcertPasses() // Teste les getters et setters pour les passes de concert
    {
        $pass = new Pass(); // Crée une nouvelle instance de Pass
        $this->assertCount(0, $pass->getConcertPasses()); // Vérifie que la collection de passes de concert est vide au départ

        $concertPass = new ConcertPass(); // Crée une nouvelle instance de ConcertPass
        $pass->addConcertPass($concertPass); // Ajoute un pass de concert à la collection
        $this->assertCount(1, $pass->getConcertPasses()); // Vérifie que la collection de passes de concert contient maintenant un élément
        $this->assertSame($concertPass, $pass->getConcertPasses()[0]); // Vérifie que le pass de concert ajouté est bien dans la collection

        $pass->removeConcertPass($concertPass); // Supprime le pass de concert de la collection
        $this->assertCount(0, $pass->getConcertPasses()); // Vérifie que la collection de passes de concert est à nouveau vide
    }
}
