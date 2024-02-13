<?php

namespace App\Tests\Entity;

use App\Entity\NotificationInfo; // L'entité NotificationInfo que nous allons tester
use PHPUnit\Framework\TestCase; // La classe de base pour tous les tests unitaires PHPUnit

class NotificationInfoTest extends TestCase // La classe de test pour l'entité NotificationInfo
{
    public function testGetAndSetId() // Teste les getters et setters pour l'ID
    {
        $notificationInfo = new NotificationInfo(); // Crée une nouvelle instance de NotificationInfo
        $this->assertNull($notificationInfo->getId()); // Vérifie que l'ID est null au départ

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetTitle() // Teste les getters et setters pour le titre
    {
        $notificationInfo = new NotificationInfo(); // Crée une nouvelle instance de NotificationInfo
        $this->assertNull($notificationInfo->getTitle()); // Vérifie que le titre est null au départ

        $notificationInfo->setTitle("Title Test"); // Définit le titre
        $this->assertSame("Title Test", $notificationInfo->getTitle()); // Vérifie que le titre a été correctement défini
    }

    public function testGetAndSetBody() // Teste les getters et setters pour le corps
    {
        $notificationInfo = new NotificationInfo(); // Crée une nouvelle instance de NotificationInfo
        $this->assertNull($notificationInfo->getBody()); // Vérifie que le corps est null au départ

        $notificationInfo->setBody("Body Test"); // Définit le corps
        $this->assertSame("Body Test", $notificationInfo->getBody()); // Vérifie que le corps a été correctement défini
    }

    public function testGetAndSetInternalLink() // Teste les getters et setters pour le lien interne
    {
        $notificationInfo = new NotificationInfo(); // Crée une nouvelle instance de NotificationInfo
        $this->assertNull($notificationInfo->getInternalLink()); // Vérifie que le lien interne est null au départ

        $notificationInfo->setInternalLink("Internal Link Test"); // Définit le lien interne
        $this->assertSame("Internal Link Test", $notificationInfo->getInternalLink()); // Vérifie que le lien interne a été correctement défini
    }
}
