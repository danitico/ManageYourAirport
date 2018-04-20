<?php

namespace App\Repository;

use App\Entity\Luggage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Luggage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Luggage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Luggage[]    findAll()
 * @method Luggage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LuggageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Luggage::class);
    }

//    /**
//     * @return Luggage[] Returns an array of Luggage objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Luggage
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
