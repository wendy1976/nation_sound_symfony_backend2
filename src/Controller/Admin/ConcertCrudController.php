<?php

namespace App\Controller\Admin;

use App\Entity\Concert;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ConcertCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Concert::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('nom_artiste'),
            Field::new('imageFile', 'Image')->setFormType(VichImageType::class)->onlyOnForms(), // Utilisez Field avec VichImageType pour le téléchargement d'images
            ImageField::new('image')->setBasePath('/images/concerts')->onlyOnIndex(), // Utilisez ImageField pour afficher les images
            TextField::new('designation')->renderAsHtml(),
            TextField::new('description')->renderAsHtml(),
            AssociationField::new('musique'),
            AssociationField::new('scene'),
            AssociationField::new('date_concert'),
        ];
    }
}