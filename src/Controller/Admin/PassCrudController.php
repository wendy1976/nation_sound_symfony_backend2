<?php

namespace App\Controller\Admin;

use App\Entity\Pass;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class PassCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pass::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('nom_pass'),
            TextField::new('description_pass')->renderAsHtml(),
            NumberField::new('prix_pass')
                ->setNumDecimals(2)
                ->setNumberFormat('%.2f €')
        ];
    }
}
 