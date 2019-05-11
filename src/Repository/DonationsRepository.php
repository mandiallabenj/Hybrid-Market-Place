<?php

namespace App\Repository;

use App\Entity\Donations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Donations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Donations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Donations[]    findAll()
 * @method Donations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Donations::class);
    }

    // /**
    //  * @return Donations[] Returns an array of Donations objects
    //  */
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
    public function findOneBySomeField($value): ?Donations
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
