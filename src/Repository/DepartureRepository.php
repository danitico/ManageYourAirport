<?php

namespace App\Repository;

use App\Entity\Departure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Departure|null find($id, $lockMode = null, $lockVersion = null)
 * @method Departure|null findOneBy(array $criteria, array $orderBy = null)
 * @method Departure[]    findAll()
 * @method Departure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepartureRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Departure::class);
    }

//    /**
//     * @return Departure[] Returns an array of Departure objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Departure
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
