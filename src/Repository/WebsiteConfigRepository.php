<?php

namespace App\Repository;

use App\Entity\WebsiteConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WebsiteConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method WebsiteConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebsiteConfig[]    findAll()
 * @method WebsiteConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebsiteConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebsiteConfig::class);
    }

    // /**
    //  * @return WebsiteConfig[] Returns an array of WebsiteConfig objects
    //  */
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
    public function findOneBySomeField($value): ?WebsiteConfig
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
