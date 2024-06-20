<?php

namespace App\Repository;

use App\Entity\Immunity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Immunity>
 *
 * @method Immunity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Immunity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Immunity[]    findAll()
 * @method Immunity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImmunityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Immunity::class);
    }

//    /**
//     * @return Immunity[] Returns an array of Immunity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Immunity
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
