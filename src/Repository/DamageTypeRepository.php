<?php

namespace App\Repository;

use App\Entity\DamageType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DamageType>
 *
 * @method DamageType|null find($id, $lockMode = null, $lockVersion = null)
 * @method DamageType|null findOneBy(array $criteria, array $orderBy = null)
 * @method DamageType[]    findAll()
 * @method DamageType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DamageTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DamageType::class);
    }

//    /**
//     * @return DamageType[] Returns an array of DamageType objects
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

//    public function findOneBySomeField($value): ?DamageType
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
