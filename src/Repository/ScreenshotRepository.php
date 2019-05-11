<?php

namespace App\Repository;

use App\Entity\Screenshot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Screenshot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Screenshot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Screenshot[]    findAll()
 * @method Screenshot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScreenshotRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Screenshot::class);
    }

    // /**
    //  * @return Screenshot[] Returns an array of Screenshot objects
    //  */
    
    public function findScreenshotsByProject($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.project = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Screenshot
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
