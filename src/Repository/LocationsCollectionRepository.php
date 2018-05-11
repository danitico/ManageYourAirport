<?php

namespace App\Repository;

use App\Entity\LocationsCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LocationsCollection|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocationsCollection|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocationsCollection[]    findAll()
 * @method LocationsCollection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationsCollectionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LocationsCollection::class);
    }

    /**
     * @return LocationsCollection[] Returns an array of LocationsCollection objects
     */
    public function getCollection($value)
    {
        $querry = $this->createQueryBuilder('l')
            ->andWhere('l.id = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery();
        return $querry->execute();
    }

//    /**
//     * @return LocationsCollection[] Returns an array of LocationsCollection objects
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
    public function findOneBySomeField($value): ?LocationsCollection
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
