<?php

namespace App\Repository;

use App\Entity\NonPlayerCharacter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NonPlayerCharacter>
 *
 * @method NonPlayerCharacter|null find($id, $lockMode = null, $lockVersion = null)
 * @method NonPlayerCharacter|null findOneBy(array $criteria, array $orderBy = null)
 * @method NonPlayerCharacter[]    findAll()
 * @method NonPlayerCharacter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NonPlayerCharacterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NonPlayerCharacter::class);
    }

    public function save(NonPlayerCharacter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NonPlayerCharacter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return NonPlayerCharacter[] Returns an array of NonPlayerCharacter objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NonPlayerCharacter
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
