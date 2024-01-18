<?php

namespace App\Repository;

use App\Entity\SecurityInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SecurityInfo>
 *
 * @method SecurityInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method SecurityInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method SecurityInfo[]    findAll()
 * @method SecurityInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecurityInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SecurityInfo::class);
    }

//    /**
//     * @return SecurityInfo[] Returns an array of SecurityInfo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SecurityInfo
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
