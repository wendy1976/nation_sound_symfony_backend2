<?php

namespace App\Repository;

use App\Entity\ConcertPass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConcertPass>
 *
 * @method ConcertPass|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConcertPass|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConcertPass[]    findAll()
 * @method ConcertPass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcertPassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConcertPass::class);
    }

//    /**
//     * @return ConcertPass[] Returns an array of ConcertPass objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ConcertPass
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
