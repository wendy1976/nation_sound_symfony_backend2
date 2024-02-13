<?php

namespace App\Controller\Admin;

use App\Entity\Pass;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController; // Classe de base pour tous les contrôleurs CRUD
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField; // Utilisé pour représenter un champ d'ID
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField; // Utilisé pour représenter un champ de texte avec éditeur
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField; // Utilisé pour représenter un champ de texte simple
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField; // Utilisé pour représenter un champ numérique
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField; // Utilisé pour représenter un champ d'image
use EasyCorp\Bundle\EasyAdminBundle\Field\Field; // Classe de base pour tous les champs
use Vich\UploaderBundle\Form\Type\VichImageType; // Utilisé pour le téléchargement et la gestion d'images
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud; // Utilisé pour configurer les options CRUD


class PassCrudController extends AbstractCrudController
{
    // Méthode pour obtenir le nom complet de l'entité gérée par ce contrôleur
    public static function getEntityFqcn(): string
    {
        return Pass::class;
    }

    // Configuration des champs à afficher dans le formulaire de gestion EasyAdmin
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(), // Champ ID, visible uniquement dans l'index
            TextField::new('nom_pass'), // Champ de nom du pass
            TextField::new('description_pass')->renderAsHtml(), // Champ de description du pass avec rendu HTML
            NumberField::new('prix_pass') // Champ de prix du pass
                ->setNumDecimals(2) // Définition du nombre de décimales
                ->setNumberFormat('%.2f €'), // Formatage du nombre avec euros
            Field::new('imageFile', 'Image') // Champ de fichier d'image
                ->setFormType(VichImageType::class) // Définition du type de formulaire pour le téléchargement d'image
                ->onlyOnForms(), // Visible uniquement dans les formulaires
            ImageField::new('imagePath') // Champ de chemin d'image
                ->setBasePath('/images/passes') // Définition du chemin de base des images
                ->onlyOnIndex(), // Visible uniquement dans l'index
        ];
    }

    // Configuration du titre du CRUD
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Pass') // Titre pour une entité individuelle
            ->setEntityLabelInPlural('Les Pass'); // Titre pour la liste des entités
    }
}
