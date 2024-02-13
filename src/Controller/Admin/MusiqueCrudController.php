<?php

namespace App\Controller\Admin;

use App\Entity\Musique;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController; // Classe de base pour tous les contrôleurs CRUD
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField; // Utilisé pour représenter un champ d'ID
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField; // Utilisé pour représenter un champ de texte avec éditeur
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField; // Utilisé pour représenter un champ de texte simple

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud; // Importation de la classe Crud pour la configuration du CRUD

class MusiqueCrudController extends AbstractCrudController
{
    // Méthode pour obtenir le nom complet de l'entité gérée par ce contrôleur
    public static function getEntityFqcn(): string
    {
        return Musique::class;
    }

    // Configuration des champs à afficher dans le formulaire de gestion EasyAdmin
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('style_musique'),
        ];
    }

    // Configuration du titre du CRUD
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Style de musique') // Titre pour une entité individuelle
            ->setEntityLabelInPlural('Styles de musique'); // Titre pour la liste des entités
    }
}

?>
