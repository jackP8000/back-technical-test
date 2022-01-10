<?php

namespace App\Repository;

use App\Entity\OrderIssues;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderIssues|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderIssues|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderIssues[]    findAll()
 * @method OrderIssues[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderIssuesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderIssues::class);
    }

    // /**
    //  * @return OrderIssues[] Returns an array of OrderIssues objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderIssues
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
