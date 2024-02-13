<?php

namespace App\Controller\Admin;

use App\Entity\DateConcert;
// Importation de la classe de base pour les contrôleurs CRUD EasyAdmin
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

// Importation de la classe pour représenter les champs d'ID dans EasyAdmin
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

// Importation de la classe pour représenter les champs de date et heure dans EasyAdmin
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

// Importation de la classe pour représenter une entité dans EasyAdmin
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;

// Importation de la classe pour représenter une recherche dans EasyAdmin
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;

// Importation de la classe pour représenter une collection de champs dans EasyAdmin
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;

// Importation de la classe pour représenter une collection de filtres dans EasyAdmin
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;

// Importation de la classe pour construire des requêtes SQL avec Doctrine ORM
use Doctrine\ORM\QueryBuilder;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud; // Importation de la classe Crud pour la configuration du CRUD


class DateConcertCrudController extends AbstractCrudController
{
    // Méthode pour obtenir le nom complet de l'entité gérée par ce contrôleur
    public static function getEntityFqcn(): string
    {
        return DateConcert::class;
    }

    // Configuration des champs à afficher dans le formulaire de gestion EasyAdmin
    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ ID, visible uniquement dans l'index
            IdField::new('id')->onlyOnIndex(),

            // Champ de date et heure, avec un format spécifié
            DateTimeField::new('date_heure')->setFormat('dd/MM/yyyy à HH:mm'),
        ];
    }

    // Modification de la requête de recherche pour filtrer par date_heure
    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        // Vérification si une recherche est effectuée
        if ($searchDto->getQuery() !== null) {
            // Conversion de la chaîne de recherche en objet DateTime
            $searchTerm = \DateTime::createFromFormat('d/m/Y à H:i', $searchDto->getQuery());

            // Si la conversion réussit, ajout du filtre à la requête
            if ($searchTerm !== false) {
                $qb->andWhere('entity.date_heure = :term')
                   ->setParameter('term', $searchTerm);
            }
        }

        return $qb;
    }

    // Configuration du titre du CRUD
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Date des concerts') // Titre pour une entité individuelle
            ->setEntityLabelInPlural('Dates des concerts'); // Titre pour la liste des entités
    }
}
