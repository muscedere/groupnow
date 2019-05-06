<?php

namespace App\Repository;

use App\Entity\Ad;
use Doctrine\ORM\Query;
use App\Entity\AdSearch;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Ad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ad[]    findAll()
 * @method Ad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ad::class);
    }

    
    public function findAllVisibleQuery(AdSearch $search):Query
    {
        $query = $this->findVisibleQuery();

        if($search->getmaxPrice())
        {
            $query = $query
                ->andWhere("p.price <= :maxprice")
                ->setParameter("maxprice", $search -> getmaxPrice());
            
        }
        if($search->getminPlace())
        {
            $query = $query
                ->andWhere("p.place <= :minplace")
                ->setParameter("minplace", $search -> getminPlace());
            
        }

        return $query->getQuery();
    }
    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
            
    }

    /*public function findBestAds($limit){
        return $this->createQueryBuilder('a')
                    ->select('a as annonce, AVG(c.rating) as avgRatings')
                    ->join('a.comments', 'c')
                    ->groupBy('a')
                    ->orderBy('avgRatings', 'DESC')
                    ->setMaxResults($limit)
                    ->getQuery()
                    ->getResult();
    }*/


//    /**
//     * @return Ad[] Returns an array of Ad objects
//     */
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
    public function findOneBySomeField($value): ?Ad
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
