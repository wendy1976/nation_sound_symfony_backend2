<?php
# Contrôleur CRUD pour afficher la liste des utilisateurs
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use App\Entity\Utilisateur;

class UtilisateurCrudController extends AbstractCrudController
{
    // Méthode pour obtenir le nom complet de l'entité gérée par ce contrôleur
    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }

    // Configuration du CRUD
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Les utilisateurs du front-end') // Titre pour la liste des utilisateurs
            ->setEntityLabelInSingular('utilisateur') // Titre pour une entité individuelle
            //->setDateFormat('d/m/Y', 'fr_FR') // Formatage de la date
            //->setTimeFormat('...') // Formatage de l'heure
            ->setPageTitle('index', 'Nation Sound - Administration des utilisateurs du front-end'); // Titre de la page index
    }
}
