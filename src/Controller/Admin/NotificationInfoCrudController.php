<?php

namespace App\Controller\Admin;

use App\Entity\NotificationInfo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NotificationInfoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NotificationInfo::class;
    }

    public function configureFields(string $pageName): iterable {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextField::new('body'),
            TextField::new('internalLink'),
        ];
    }
}
