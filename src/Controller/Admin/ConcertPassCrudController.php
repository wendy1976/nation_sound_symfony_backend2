<?php

namespace App\Controller\Admin;

use App\Entity\ConcertPass;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud; // Importation de la classe Crud pour la configuration du CRUD

class ConcertPassCrudController extends AbstractCrudController
{
    // Méthode pour obtenir le nom complet de l'entité gérée par ce contrôleur
    public static function getEntityFqcn(): string
    {
        return ConcertPass::class;
    }

    // Configuration des champs à afficher dans le formulaire de gestion EasyAdmin
    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ d'association pour le concert
            AssociationField::new('concert'),

            // Champ d'association pour le pass
            AssociationField::new('pass'),
        ];
    }
    // Configuration du titre du CRUD
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Concert et Pass') // Titre pour une entité individuelle
            ->setEntityLabelInPlural('Concerts et Pass'); // Titre pour la liste des entités
    }
}
