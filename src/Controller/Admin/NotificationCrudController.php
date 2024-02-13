<?php

namespace App\Controller\Admin;

use App\Entity\Notification; // Utilisé pour interagir avec l'entité Notification de votre application
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController; // Classe de base pour tous les contrôleurs CRUD
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField; // Utilisé pour représenter un champ de texte simple
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField; // Utilisé pour représenter un champ d'ID
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud; // Utilisé pour configurer les options CRUD


class NotificationCrudController extends AbstractCrudController {
    // Méthode pour obtenir le nom complet de l'entité gérée par ce contrôleur
    public static function getEntityFqcn(): string {
        return Notification::class;
    }

    // Configuration des champs à afficher dans le formulaire de gestion EasyAdmin
    public function configureFields(string $pageName): iterable {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextField::new('body'),
            TextField::new('externalLink'),
        ];
    }

    // Configuration du titre du CRUD
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Notification d\'alerte') // Titre pour une entité individuelle
            ->setEntityLabelInPlural('Notifications d\'alertes'); // Titre pour la liste des entités
    }
}

