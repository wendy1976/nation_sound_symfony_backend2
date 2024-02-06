<?php

namespace App\Controller\Admin;

use App\Entity\Location;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

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
