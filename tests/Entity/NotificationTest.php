<?php

namespace App\Tests\Entity;

use App\Entity\Notification; // L'entité Notification que nous allons tester
use PHPUnit\Framework\TestCase; // La classe de base pour tous les tests unitaires PHPUnit

class NotificationTest extends TestCase // La classe de test pour l'entité Notification
{
    public function testGetAndSetId() // Teste les getters et setters pour l'ID
    {
        $notification = new Notification(); // Crée une nouvelle instance de Notification
        $this->assertNull($notification->getId()); // Vérifie que l'ID est null au départ

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetTitle() // Teste les getters et setters pour le titre
    {
        $notification = new Notification(); // Crée une nouvelle instance de Notification
        $this->assertNull($notification->getTitle()); // Vérifie que le titre est null au départ

        $notification->setTitle("Title Test"); // Définit le titre
        $this->assertSame("Title Test", $notification->getTitle()); // Vérifie que le titre a été correctement défini
    }

    public function testGetAndSetBody() // Teste les getters et setters pour le corps
    {
        $notification = new Notification(); // Crée une nouvelle instance de Notification
        $this->assertNull($notification->getBody()); // Vérifie que le corps est null au départ

        $notification->setBody("Body Test"); // Définit le corps
        $this->assertSame("Body Test", $notification->getBody()); // Vérifie que le corps a été correctement défini
    }

    public function testGetAndSetExternalLink() // Teste les getters et setters pour le lien externe
    {
        $notification = new Notification(); // Crée une nouvelle instance de Notification
        $this->assertNull($notification->getExternalLink()); // Vérifie que le lien externe est null au départ

        $notification->setExternalLink("External Link Test"); // Définit le lien externe
        $this->assertSame("External Link Test", $notification->getExternalLink()); // Vérifie que le lien externe a été correctement défini
    }
}
