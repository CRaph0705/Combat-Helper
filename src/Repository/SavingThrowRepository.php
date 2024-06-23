<?php

namespace App\Repository;

use App\Entity\SavingThrow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SavingThrow>
 *
 * @method SavingThrow|null find($id, $lockMode = null, $lockVersion = null)
 * @method SavingThrow|null findOneBy(array $criteria, array $orderBy = null)
 * @method SavingThrow[]    findAll()
 * @method SavingThrow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SavingThrowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SavingThrow::class);
    }

//    /**
//     * @return SavingThrow[] Returns an array of SavingThrow objects
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

//    public function findOneBySomeField($value): ?SavingThrow
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
