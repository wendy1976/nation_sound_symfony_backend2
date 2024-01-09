<?php

namespace App\Repository;

use App\Entity\DateConcert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DateConcert>
 *
 * @method DateConcert|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateConcert|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateConcert[]    findAll()
 * @method DateConcert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateConcertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateConcert::class);
    }

//    /**
//     * @return DateConcert[] Returns an array of DateConcert objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DateConcert
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}