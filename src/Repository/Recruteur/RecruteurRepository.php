<?php
namespace App\Repository\Recruteur;
use App\Entity\Recruteur\Recruteur;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Recruteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recruteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recruteur[]    findAll()
 * @method Recruteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecruteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recruteur::class);
    }

    // /**
    //  * @return Recruteur[] Returns an array of Recruteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recruteur
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
