<?php

namespace App\Repository;

use App\Entity\Projectfiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Projectfiles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projectfiles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projectfiles[]    findAll()
 * @method Projectfiles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectfilesRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Projectfiles::class);
    }

    /**
     * @return Projectfiles[] Returns an array of Projectfiles objects
     */
    public function findAllfilesByProject($value) {
        return $this->createQueryBuilder('p')
                        ->andWhere('p.project = :val')
                        ->setParameter('val', $value)
                        ->orderBy('p.id', 'DESC')
                        ->setMaxResults(10)
                        ->getQuery()
                        ->getResult()
        ;
    }

    
    public function findNumberOffilesByProject($value) {
        return $this->createQueryBuilder('i')
                        ->andWhere('i.project = :val')
                        ->setParameter('val', $value)
                        ->orderBy('i.id', 'ASC')
                        ->select('COUNT(i.id) as numberOffilesByProject')
                        ->getQuery()
                        ->getSingleScalarResult()
        ;
    }

    /*
      public function findOneBySomeField($value): ?Projectfiles
      {
      return $this->createQueryBuilder('p')
      ->andWhere('p.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
}
