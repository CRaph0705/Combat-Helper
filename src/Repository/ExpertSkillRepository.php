<?php

namespace App\Repository;

use App\Entity\ExpertSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExpertSkill>
 *
 * @method ExpertSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExpertSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExpertSkill[]    findAll()
 * @method ExpertSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpertSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExpertSkill::class);
    }

//    /**
//     * @return ExpertSkill[] Returns an array of ExpertSkill objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExpertSkill
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
