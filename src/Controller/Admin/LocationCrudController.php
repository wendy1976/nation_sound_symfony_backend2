<?php

namespace App\Controller\Admin;

use App\Entity\Location;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField; // Utilisé pour représenter un champ d'ID
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField; // Utilisé pour représenter un champ de texte avec éditeur
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField; // Utilisé pour représenter un champ de texte simple
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField; // Utilisé pour représenter un champ de tableau
use EasyCorp\Bundle\EasyAdminBundle\Field\Field; // Classe de base pour tous les champs
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField; // Utilisé pour représenter un champ d'image
use Vich\UploaderBundle\Form\Type\VichImageType; // Utilisé pour le téléchargement et la gestion d'images
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud; // Utilisé pour configurer les options CRUD


class LocationCrudController extends AbstractCrudController
{
    // Méthode pour obtenir le nom complet de l'entité gérée par ce contrôleur
    public static function getEntityFqcn(): string
    {
        return Location::class;
    }

    // Configuration des champs à afficher dans le formulaire de gestion EasyAdmin
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('category'),
            ArrayField::new('coordinates'),
            Field::new('iconFile', 'Icone')->setFormType(VichImageType::class)->onlyOnForms(),
            ImageField::new('icon')->setBasePath('/images/location')->onlyOnIndex(), // Change 'iconFile' to 'icon'
            TextField::new('name'),
            TextEditorField::new('popupContent'),
            Field::new('imageFile', 'Image')->setFormType(VichImageType::class)->onlyOnForms(),
            ImageField::new('image')->setBasePath('/images/location')->onlyOnIndex(), // Change 'imageFile' to 'image'
        ];
    }

    // Configuration du titre du CRUD
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Localisation') // Titre pour une entité individuelle
            ->setEntityLabelInPlural('Localisations'); // Titre pour la liste des entités
    }
}
