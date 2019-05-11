<?php

namespace App\Repository;

use App\Entity\Reserve;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Reserve|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reserve|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reserve[]    findAll()
 * @method Reserve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReserveRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reserve::class);
    }

    // /**
    //  * @return Reserve[] Returns an array of Reserve objects
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
    public function findOneBySomeField($value): ?Reserve
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    //Retourne toutes les reservations en cours
    public function findAllCurrentReservation()
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.state = 0')
            ->orderBy('r.reserveDate', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    // retourne liste des livres actuellement réservés par l'utilisateur.
    public function findUserReservation(User $user)
    {
        $date = new \DateTime('now');
        $date->add(new \DateInterval('P2D'));

        return $this->createQueryBuilder('r')
            ->andWhere('r.user = :val')
            ->andWhere('r.reserveDate <= CURRENT_DATE()')
            ->andWhere('r.reserveDate <= :val2')
            ->setParameter('val', $user)
            ->setParameter('val2', $date)
            ->orderBy('r.reserveDate', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

        public function countUserRes(User $user) {
            $date = new \DateTime('now');
            $date->add(new \DateInterval('P2D'));

            return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->andWhere('r.user = :val')
            ->andWhere('r.reserveDate <= CURRENT_DATE()')
            ->andWhere('r.reserveDate <= :val2')
            ->setParameter('val', $user)
            ->setParameter('val2', $date)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
