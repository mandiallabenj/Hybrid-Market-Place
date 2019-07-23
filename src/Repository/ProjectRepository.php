<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Project::class);
    }

    // /**
    //  * @return Project[] Returns an array of Project objects
    //  */
    /*
      public function findByExampleField($value)
      {
      return $this->createQueryBuilder('p')
      ->andWhere('p.exampleField = :val')
      ->setParameter('val', $value)
      ->orderBy('p.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult()
      ;
      }
     */


    public function findOneProject($value) {
        return $this->createQueryBuilder('p')
                        ->andWhere('p.id = :val')
                        ->setParameter('val', $value)
                        ->getQuery()
                        ->getOneOrNullResult()
        ;
    }

    public function findAllNumberOfProjects() {

        return $this->createQueryBuilder('u')
                        ->select('COUNT(u.id) as Total_Number_of_Projects')
                        ->getQuery()
                        ->getSingleScalarResult()
        ;
    }

    /**
     * 
     * @return Project[] Returns an array of Project objects
     */
    public function findAllSearchBy($value) {
        return $this->createQueryBuilder('p')
                        ->andWhere('p.title LIKE :value OR p.description LIKE :value')
                        ->setParameter('value', '%' . $value . '%')
                        ->orderBy('p.id', 'DESC')
                        ->setMaxResults(10)
                        ->getQuery()
                        ->getResult()
        ;
    }

    public function findAllEnterpriseProjects() {

        return $this->createQueryBuilder('u')
                        ->andWhere('p.is_enterprise LIKE :YES')
                        ->orderBy('p.id', 'DESC')
                        ->setMaxResults(10)
                        ->getQuery()
                        ->getResult()
        ;
    }

}
