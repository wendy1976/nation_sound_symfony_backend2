<?php

namespace App\Tests\Entity;

use App\Entity\Location; // L'entité Location que nous allons tester
use PHPUnit\Framework\TestCase; // La classe de base pour tous les tests unitaires PHPUnit

class LocationTest extends TestCase // La classe de test pour l'entité Location
{
    public function testGetAndSetId() // Teste les getters et setters pour l'ID
    {
        $location = new Location(); // Crée une nouvelle instance de Location
        $this->assertNull($location->getId()); // Vérifie que l'ID est null au départ

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetCategory() // Teste les getters et setters pour la catégorie
    {
        $location = new Location(); // Crée une nouvelle instance de Location
        $this->assertNull($location->getCategory()); // Vérifie que la catégorie est null au départ

        $location->setCategory("Category Test"); // Définit la catégorie
        $this->assertSame("Category Test", $location->getCategory()); // Vérifie que la catégorie a été correctement définie
    }

    public function testGetAndSetCoordinates() // Teste les getters et setters pour les coordonnées
    {
        $location = new Location(); // Crée une nouvelle instance de Location
        $this->assertEmpty($location->getCoordinates()); // Vérifie que les coordonnées sont vides au départ

        $coordinates = ['lat' => 48.8566, 'lon' => 2.3522]; // Crée un tableau de coordonnées
        $location->setCoordinates($coordinates); // Définit les coordonnées
        $this->assertSame($coordinates, $location->getCoordinates()); // Vérifie que les coordonnées ont été correctement définies
    }

    public function testGetAndSetName() // Teste les getters et setters pour le nom
    {
        $location = new Location(); // Crée une nouvelle instance de Location
        $this->assertNull($location->getName()); // Vérifie que le nom est null au départ

        $location->setName("Name Test"); // Définit le nom
        $this->assertSame("Name Test", $location->getName()); // Vérifie que le nom a été correctement défini
    }

    public function testGetAndSetPopupContent() // Teste les getters et setters pour le contenu de la popup
    {
        $location = new Location(); // Crée une nouvelle instance de Location
        $this->assertNull($location->getPopupContent()); // Vérifie que le contenu de la popup est null au départ

        $location->setPopupContent("Popup Content Test"); // Définit le contenu de la popup
        $this->assertSame("Popup Content Test", $location->getPopupContent()); // Vérifie que le contenu de la popup a été correctement défini
    }
}
