<?php

namespace App\Repository\offreEmploi;

use App\Data\SearchData;
use App\Entity\offreEmploi\OffreEmploi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Migrations\Query\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OffreEmploi|null find($id, $lockMode = null, $lockVersion = null)
 * @method OffreEmploi|null findOneBy(array $criteria, array $orderBy = null)
 * @method OffreEmploi[]    findAll()
 * @method OffreEmploi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreEmploiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffreEmploi::class);
    }
    /**
     * @return OffreEmploi[]
     */
    public function findSearch(SearchData $search):array
    {
        $query = $this
        ->createQueryBuilder('p')
            ->join('p.categorie','c')
            ->select('c','p')

        ;
        if(!empty($search->q)){
            $query = $query
            ->andWhere('p.Titre LIKE :q OR p.Description LIKE :q')
            ->setParameter('q', "%{$search->q}%");
        }
        if(!empty($search->categorie)){
            $query=$query
            ->andWhere('c.id IN (:categorie)')
            ->setParameter('categorie',$search->categorie); 
        }


        return $query->getQuery()->getResult();

    }

    // /**
    //  * @return OffreEmploi[] Returns an array of OffreEmploi objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OffreEmploi
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
