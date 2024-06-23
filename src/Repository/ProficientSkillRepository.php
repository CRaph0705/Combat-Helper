<?php

namespace App\Repository;

use App\Entity\ProficientSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProficientSkill>
 *
 * @method ProficientSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProficientSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProficientSkill[]    findAll()
 * @method ProficientSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProficientSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProficientSkill::class);
    }

//    /**
//     * @return ProficientSkill[] Returns an array of ProficientSkill objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProficientSkill
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
