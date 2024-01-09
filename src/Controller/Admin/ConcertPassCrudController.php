<?php

namespace App\Controller\Admin;

use App\Entity\ConcertPass;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ConcertPassCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ConcertPass::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            
            AssociationField::new('concert'),
            AssociationField::new('pass'),
        ];
    }
}