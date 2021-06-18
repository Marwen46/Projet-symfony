<?php

namespace App\Repository;

use App\Entity\Acceptees;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Acceptees|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acceptees|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acceptees[]    findAll()
 * @method Acceptees[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccepteesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Acceptees::class);
    }

    public function findLastInserted()
{
    return $this
        ->createQueryBuilder("e")
        ->orderBy("e.id", "DESC")
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult();
}
    // /**
    //  * @return Acceptees[] Returns an array of Acceptees objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Acceptees
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
