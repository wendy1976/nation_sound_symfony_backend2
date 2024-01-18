<?php

namespace App\Controller\Admin;

use App\Entity\SecurityInfo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SecurityInfoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SecurityInfo::class;
    }

    public function configureFields(string $pageName): iterable {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextField::new('body'),
        ];
    }
}
