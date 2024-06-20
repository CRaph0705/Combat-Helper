<?php

namespace App\Repository;

use App\Entity\Resistance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Resistance>
 *
 * @method Resistance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resistance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resistance[]    findAll()
 * @method Resistance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResistanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resistance::class);
    }

//    /**
//     * @return Resistance[] Returns an array of Resistance objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Resistance
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
