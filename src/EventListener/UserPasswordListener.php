<?php

namespace App\EventListener;

use App\Entity\Utilisateur;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserPasswordListener implements EventSubscriberInterface
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    // Définition des événements auxquels ce listener doit souscrire
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['hashPassword'], // Avant qu'une entité soit persistée pour la première fois
            BeforeEntityUpdatedEvent::class => ['hashPassword'], // Avant qu'une entité existante soit mise à jour
        ];
    }

    // Méthode pour hasher le mot de passe de l'utilisateur avant la persistance ou la mise à jour de l'entité Utilisateur
    public function hashPassword($event)
    {
        $entity = $event->getEntityInstance();

        // Vérifie si l'entité est une instance de Utilisateur
        if (!($entity instanceof Utilisateur)) {
            return; // Sortie de la méthode si l'entité n'est pas une instance de Utilisateur
        }

        // Hachage du mot de passe de l'utilisateur à l'aide du service de hachage de mots de passe injecté
        $entity->setPassword($this->passwordHasher->hashPassword($entity, $entity->getPassword()));
    }
}
