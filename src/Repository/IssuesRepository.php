<?php

namespace App\Repository;

use App\Entity\Issues;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Issues|null find($id, $lockMode = null, $lockVersion = null)
 * @method Issues|null findOneBy(array $criteria, array $orderBy = null)
 * @method Issues[]    findAll()
 * @method Issues[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IssuesRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Issues::class);
    }

    // /**
    //  * @return Issues[] Returns an array of Issues objects
    //  */

    public function findAllIssues() {
        return $this->createQueryBuilder('i')
                        ->orderBy('i.id', 'DESC')
                        ->setMaxResults(20)
                        ->getQuery()
                        ->getResult()
        ;
    }

    public function findAllIssuesOfProject($value) {
        return $this->createQueryBuilder('i')
                        ->andWhere('i.project = :val')
                        ->setParameter('val', $value)
                        ->orderBy('i.id', 'ASC')
                        ->setMaxResults(10)
                        ->getQuery()
                        ->getResult()
        ;
    }

    public function findNumberOfIssuesOfProject($value) {
        return $this->createQueryBuilder('i')
        ->andWhere('i.project = :val')
        ->setParameter('val', $value)
        ->orderBy('i.id', 'ASC')
        ->select('COUNT(i.id) as NumberOfIssues')
        ->getQuery()
        ->getSingleScalarResult()
        ;
    }

    public function findOneIssue($value) {
        return $this->createQueryBuilder('p')
                        ->andWhere('p.id = :val')
                        ->setParameter('val', $value)
                        ->getQuery()
                        ->getOneOrNullResult()
        ;
    }

    /*
      public function findOneBySomeField($value): ?Issues
      {
      return $this->createQueryBuilder('i')
      ->andWhere('i.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
}
