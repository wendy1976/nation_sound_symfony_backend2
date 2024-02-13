<?php

namespace App\Tests\Entity;

use App\Entity\Utilisateur; // L'entité Utilisateur que nous allons tester
use PHPUnit\Framework\TestCase; // La classe de base pour tous les tests unitaires PHPUnit

class UtilisateurTest extends TestCase // La classe de test pour l'entité Utilisateur
{
    public function testGetAndSetId() // Teste les getters et setters pour l'ID
    {
        $utilisateur = new Utilisateur(); // Crée une nouvelle instance de Utilisateur
        $this->assertNull($utilisateur->getId()); // Vérifie que l'ID est null au départ

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetNom() // Teste les getters et setters pour le nom
    {
        $utilisateur = new Utilisateur(); // Crée une nouvelle instance de Utilisateur
        $this->assertNull($utilisateur->getNom()); // Vérifie que le nom est null au départ

        $utilisateur->setNom("Nom Test"); // Définit le nom
        $this->assertSame("Nom Test", $utilisateur->getNom()); // Vérifie que le nom a été correctement défini
    }

    public function testGetAndSetPrenom() // Teste les getters et setters pour le prénom
    {
        $utilisateur = new Utilisateur(); // Crée une nouvelle instance de Utilisateur
        $this->assertNull($utilisateur->getPrenom()); // Vérifie que le prénom est null au départ

        $utilisateur->setPrenom("Prenom Test"); // Définit le prénom
        $this->assertSame("Prenom Test", $utilisateur->getPrenom()); // Vérifie que le prénom a été correctement défini
    }

    public function testGetAndSetEmail() // Teste les getters et setters pour l'email
    {
        $utilisateur = new Utilisateur(); // Crée une nouvelle instance de Utilisateur
        $this->assertNull($utilisateur->getEmail()); // Vérifie que l'email est null au départ

        $utilisateur->setEmail("email@test.com"); // Définit l'email
        $this->assertSame("email@test.com", $utilisateur->getEmail()); // Vérifie que l'email a été correctement défini
    }

    public function testGetAndSetPassword() // Teste les getters et setters pour le mot de passe
    {
        $utilisateur = new Utilisateur(); // Crée une nouvelle instance de Utilisateur
        $this->assertNull($utilisateur->getPassword()); // Vérifie que le mot de passe est null au départ

        $utilisateur->setPassword("password"); // Définit le mot de passe
        $this->assertSame("password", $utilisateur->getPassword()); // Vérifie que le mot de passe a été correctement défini
    }

    public function testGetAndSetEmailConfirmation() // Teste les getters et setters pour la confirmation de l'email
    {
        $utilisateur = new Utilisateur(); // Crée une nouvelle instance de Utilisateur
        $this->assertNull($utilisateur->getEmailConfirmation()); // Vérifie que la confirmation de l'email est null au départ

        $utilisateur->setEmailConfirmation("emailConfirmation@test.com"); // Définit la confirmation de l'email
        $this->assertSame("emailConfirmation@test.com", $utilisateur->getEmailConfirmation()); // Vérifie que la confirmation de l'email a été correctement définie
    }
}
