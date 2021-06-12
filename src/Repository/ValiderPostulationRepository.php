<?php

namespace App\Repository;

use App\Entity\ValiderPostulation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ValiderPostulation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValiderPostulation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValiderPostulation[]    findAll()
 * @method ValiderPostulation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValiderPostulationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ValiderPostulation::class);
    }

    // /**
    //  * @return ValiderPostulation[] Returns an array of ValiderPostulation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ValiderPostulation
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
