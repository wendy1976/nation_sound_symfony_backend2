<?php

namespace App\Tests\Entity;

use App\Entity\SecurityInfo; // L'entité SecurityInfo que nous allons tester
use PHPUnit\Framework\TestCase; // La classe de base pour tous les tests unitaires PHPUnit

class SecurityInfoTest extends TestCase // La classe de test pour l'entité SecurityInfo
{
    public function testGetAndSetId() // Teste les getters et setters pour l'ID
    {
        $securityInfo = new SecurityInfo(); // Crée une nouvelle instance de SecurityInfo
        $this->assertNull($securityInfo->getId()); // Vérifie que l'ID est null au départ

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetTitle() // Teste les getters et setters pour le titre
    {
        $securityInfo = new SecurityInfo(); // Crée une nouvelle instance de SecurityInfo
        $this->assertNull($securityInfo->getTitle()); // Vérifie que le titre est null au départ

        $securityInfo->setTitle("Title Test"); // Définit le titre
        $this->assertSame("Title Test", $securityInfo->getTitle()); // Vérifie que le titre a été correctement défini
    }

    public function testGetAndSetBody() // Teste les getters et setters pour le corps
    {
        $securityInfo = new SecurityInfo(); // Crée une nouvelle instance de SecurityInfo
        $this->assertNull($securityInfo->getBody()); // Vérifie que le corps est null au départ

        $securityInfo->setBody("Body Test"); // Définit le corps
        $this->assertSame("Body Test", $securityInfo->getBody()); // Vérifie que le corps a été correctement défini
    }
}
