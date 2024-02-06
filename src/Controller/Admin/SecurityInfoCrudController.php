<?php

namespace App\Controller\Admin;

use App\Entity\SecurityInfo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class SecurityInfoCrudController extends AbstractCrudController
{
    // Méthode pour obtenir le nom complet de l'entité gérée par ce contrôleur
    public static function getEntityFqcn(): string
    {
        return SecurityInfo::class;
    }

    // Configuration des champs à afficher dans le formulaire de gestion EasyAdmin
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Champ ID, caché dans le formulaire
            TextField::new('title'), // Champ de titre
            TextField::new('body'), // Champ de contenu
        ];
    }

    // Configuration du titre du CRUD
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Information de sécurité') // Titre pour une entité individuelle
            ->setEntityLabelInPlural('Informations de sécurité'); // Titre pour la liste des entités
    }
}

?>
