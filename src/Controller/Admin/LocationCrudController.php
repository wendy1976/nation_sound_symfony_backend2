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

class LocationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Location::class;
    }

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
}