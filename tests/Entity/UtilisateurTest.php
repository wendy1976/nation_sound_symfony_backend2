<?php

namespace App\Tests\Entity;

use App\Entity\Utilisateur;
use PHPUnit\Framework\TestCase;

class UtilisateurTest extends TestCase
{
    public function testGetAndSetId()
    {
        $utilisateur = new Utilisateur();
        $this->assertNull($utilisateur->getId());

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetNom()
    {
        $utilisateur = new Utilisateur();
        $this->assertNull($utilisateur->getNom());

        $utilisateur->setNom("Nom Test");
        $this->assertSame("Nom Test", $utilisateur->getNom());
    }

    public function testGetAndSetPrenom()
    {
        $utilisateur = new Utilisateur();
        $this->assertNull($utilisateur->getPrenom());

        $utilisateur->setPrenom("Prenom Test");
        $this->assertSame("Prenom Test", $utilisateur->getPrenom());
    }

    public function testGetAndSetEmail()
    {
        $utilisateur = new Utilisateur();
        $this->assertNull($utilisateur->getEmail());

        $utilisateur->setEmail("email@test.com");
        $this->assertSame("email@test.com", $utilisateur->getEmail());
    }

    public function testGetAndSetPassword()
    {
        $utilisateur = new Utilisateur();
        $this->assertNull($utilisateur->getPassword());

        $utilisateur->setPassword("password");
        $this->assertSame("password", $utilisateur->getPassword());
    }

    public function testGetAndSetEmailConfirmation()
    {
        $utilisateur = new Utilisateur();
        $this->assertNull($utilisateur->getEmailConfirmation());

        $utilisateur->setEmailConfirmation("emailConfirmation@test.com");
        $this->assertSame("emailConfirmation@test.com", $utilisateur->getEmailConfirmation());
    }
}
