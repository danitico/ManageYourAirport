<?php

namespace App\Repository;

use App\Entity\Watson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Watson|null find($id, $lockMode = null, $lockVersion = null)
 * @method Watson|null findOneBy(array $criteria, array $orderBy = null)
 * @method Watson[]    findAll()
 * @method Watson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WatsonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Watson::class);
    }

//    /**
//     * @return Watson[] Returns an array of Watson objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Watson
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
