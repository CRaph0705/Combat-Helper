<?php

namespace App\Repository;

use App\Entity\EncounterPlayerCharacter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EncounterPlayerCharacter>
 *
 * @method EncounterPlayerCharacter|null find($id, $lockMode = null, $lockVersion = null)
 * @method EncounterPlayerCharacter|null findOneBy(array $criteria, array $orderBy = null)
 * @method EncounterPlayerCharacter[]    findAll()
 * @method EncounterPlayerCharacter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EncounterPlayerCharacterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EncounterPlayerCharacter::class);
    }

    public function save(EncounterPlayerCharacter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EncounterPlayerCharacter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EncounterPlayerCharacter[] Returns an array of EncounterPlayerCharacter objects
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

//    public function findOneBySomeField($value): ?EncounterPlayerCharacter
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
