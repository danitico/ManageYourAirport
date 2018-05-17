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

    /**
     * @return Luggage[] Returns an array of lost luggages
     */

    public function getLostLuggage()
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.isLost = true')
            ->orderBy('l.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }



    /**
     * @return Luggage[] Returns an array of lost luggages
     */

    public function getAllLuggage()
    {
        return $this->createQueryBuilder('l')
            ->orderBy('l.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Luggage[] Returns an array of lost luggages
     */

    public function findById($id)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.airlineId = :val')
            ->setParameter('val', $id)
            ->orderBy('l.airlineId', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

}
