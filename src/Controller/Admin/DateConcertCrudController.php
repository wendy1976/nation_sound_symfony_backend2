<?php

namespace App\Controller\Admin;

use App\Entity\DateConcert;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use Doctrine\ORM\QueryBuilder;

class DateConcertCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DateConcert::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            DateTimeField::new('date_heure')->setFormat('dd/MM/yyyy à HH:mm'),
        ];
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
{
    $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

    if ($searchDto->getQuery() !== null) {
        $searchTerm = \DateTime::createFromFormat('d/m/Y à H:i', $searchDto->getQuery());

        if ($searchTerm !== false) {
            $qb->andWhere('entity.date_heure = :term')
               ->setParameter('term', $searchTerm);
        }
    }

    return $qb;
    }
}
