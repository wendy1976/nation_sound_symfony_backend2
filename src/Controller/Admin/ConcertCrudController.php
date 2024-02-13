<?php

namespace App\Controller\Admin;

use App\Entity\Concert;
// Importation de la classe de base pour les contrôleurs CRUD EasyAdmin
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

// Importation des classes pour représenter différents types de champs dans EasyAdmin
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

// Importation de la classe pour gérer l'upload d'images avec VichUploaderBundle
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud; // Importation de la classe Crud pour la configuration du CRUD

class ConcertCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Concert::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // Configuration des champs à afficher dans le formulaire de gestion EasyAdmin

        return [
            // Champ ID, visible uniquement dans l'index
            IdField::new('id')->onlyOnIndex(),

            // Champ de texte pour le nom de l'artiste
            TextField::new('nom_artiste'),

            // Champ de téléchargement de fichier pour l'image, utilisant VichImageType
            Field::new('imageFile', 'Image')->setFormType(VichImageType::class)->onlyOnForms(),

            // Champ d'image pour afficher les images, avec un chemin de base défini
            ImageField::new('image')->setBasePath('/images/concerts')->onlyOnIndex(),

            // Champ de texte pour la désignation, rendu en HTML
            TextField::new('designation')->renderAsHtml(),

            // Champ de texte pour la description, rendu en HTML
            TextField::new('description')->renderAsHtml(),

            // Champ d'association pour la musique
            AssociationField::new('musique'),

            // Champ d'association pour la scène
            AssociationField::new('scene'),

            // Champ d'association pour la date du concert
            AssociationField::new('date_concert'),
        ];
    }
    // Configuration du titre du CRUD
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Concert') // Titre pour une entité individuelle
            ->setEntityLabelInPlural('Concerts'); // Titre pour la liste des entités
    }
}
