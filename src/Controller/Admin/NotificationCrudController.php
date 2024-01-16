<?php

namespace App\Controller\Admin;

use App\Entity\Notification;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class NotificationCrudController extends AbstractCrudController {
    public static function getEntityFqcn(): string {
        return Notification::class;
    }

    public function configureFields(string $pageName): iterable {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextField::new('body'),
            TextField::new('externalLink'),
        ];
    }
}