<?php

namespace App\Controller\Admin;

use App\Entity\NotificationInfo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController; // Classe de base pour tous les contrôleurs CRUD
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField; // Utilisé pour représenter un champ d'ID
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField; // Utilisé pour représenter un champ de texte avec éditeur
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField; // Utilisé pour représenter un champ de texte simple
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud; // Utilisé pour configurer les options CRUD


class NotificationInfoCrudController extends AbstractCrudController
{
    // Méthode pour obtenir le nom complet de l'entité gérée par ce contrôleur
    public static function getEntityFqcn(): string
    {
        return NotificationInfo::class;
    }

    // Configuration des champs à afficher dans le formulaire de gestion EasyAdmin
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Champ ID, caché dans le formulaire
            TextField::new('title'), // Champ de titre
            TextField::new('body'), // Champ de contenu
            TextField::new('internalLink'), // Champ de lien interne
        ];
    }

    // Configuration du titre du CRUD
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Notification d\'information') // Titre pour une entité individuelle
            ->setEntityLabelInPlural('Notifications d\'informations'); // Titre pour la liste des entités
    }
}
