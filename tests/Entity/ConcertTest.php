<?php

namespace App\Tests\Entity;

use App\Entity\Concert; // L'entité Concert que nous allons tester
use App\Entity\DateConcert; // L'entité DateConcert utilisée dans les tests
use App\Entity\Scene; // L'entité Scene utilisée dans les tests
use App\Entity\Musique; // L'entité Musique utilisée dans les tests
use PHPUnit\Framework\TestCase; // La classe de base pour tous les tests unitaires PHPUnit

class ConcertTest extends TestCase // La classe de test pour l'entité Concert
{
    public function testGetAndSetId() // Teste les getters et setters pour l'ID
    {
        $concert = new Concert(); // Crée une nouvelle instance de Concert
        $this->assertNull($concert->getId()); // Vérifie que l'ID est null au départ

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetNomArtiste() // Teste les getters et setters pour le nom de l'artiste
    {
        $concert = new Concert(); // Crée une nouvelle instance de Concert
        $this->assertNull($concert->getNomArtiste()); // Vérifie que le nom de l'artiste est null au départ

        $concert->setNomArtiste("Artiste Test"); // Définit le nom de l'artiste
        $this->assertSame("Artiste Test", $concert->getNomArtiste()); // Vérifie que le nom de l'artiste a été correctement défini
    }

    public function testGetAndSetDesignation() // Teste les getters et setters pour la désignation
    {
        $concert = new Concert(); // Crée une nouvelle instance de Concert
        $this->assertNull($concert->getDesignation()); // Vérifie que la désignation est null au départ

        $concert->setDesignation("Designation Test"); // Définit la désignation
        $this->assertSame("Designation Test", $concert->getDesignation()); // Vérifie que la désignation a été correctement définie
    }

    public function testGetAndSetDescription() // Teste les getters et setters pour la description
    {
        $concert = new Concert(); // Crée une nouvelle instance de Concert
        $this->assertNull($concert->getDescription()); // Vérifie que la description est null au départ

        $concert->setDescription("Description Test"); // Définit la description
        $this->assertSame("Description Test", $concert->getDescription()); // Vérifie que la description a été correctement définie
    }

    public function testGetAndSetDateConcert() // Teste les getters et setters pour la date du concert
    {
        $concert = new Concert(); // Crée une nouvelle instance de Concert
        $this->assertNull($concert->getDateConcert()); // Vérifie que la date du concert est null au départ

        $dateConcert = new DateConcert(); // Crée une nouvelle instance de DateConcert
        $concert->setDateConcert($dateConcert); // Définit la date du concert
        $this->assertSame($dateConcert, $concert->getDateConcert()); // Vérifie que la date du concert a été correctement définie
    }

    public function testGetAndSetScene() // Teste les getters et setters pour la scène
    {
        $concert = new Concert(); // Crée une nouvelle instance de Concert
        $this->assertNull($concert->getScene()); // Vérifie que la scène est null au départ

        $scene = new Scene(); // Crée une nouvelle instance de Scene
        $concert->setScene($scene); // Définit la scène
        $this->assertSame($scene, $concert->getScene()); // Vérifie que la scène a été correctement définie
    }

    public function testGetAndSetMusique() // Teste les getters et setters pour la musique
    {
        $concert = new Concert(); // Crée une nouvelle instance de Concert
        $this->assertNull($concert->getMusique()); // Vérifie que la musique est null au départ

        $musique = new Musique(); // Crée une nouvelle instance de Musique
        $concert->setMusique($musique); // Définit la musique
        $this->assertSame($musique, $concert->getMusique()); // Vérifie que la musique a été correctement définie
    }
}
