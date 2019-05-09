<?php

namespace App\Repository;

use App\Entity\StockMoving;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StockMoving|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockMoving|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockMoving[]    findAll()
 * @method StockMoving[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockMovingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StockMoving::class);
    }

    // /**
    //  * @return StockMoving[] Returns an array of StockMoving objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StockMoving
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
