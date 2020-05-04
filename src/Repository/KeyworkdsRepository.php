<?php

namespace App\Repository;

use App\Entity\Keyworkds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Keyworkds|null find($id, $lockMode = null, $lockVersion = null)
 * @method Keyworkds|null findOneBy(array $criteria, array $orderBy = null)
 * @method Keyworkds[]    findAll()
 * @method Keyworkds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KeyworkdsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Keyworkds::class);
    }

    // /**
    //  * @return Keyworkds[] Returns an array of Keyworkds objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Keyworkds
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
