<?php

namespace App\Repository;

use App\Entity\Items;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Items|null find($id, $lockMode = null, $lockVersion = null)
 * @method Items|null findOneBy(array $criteria, array $orderBy = null)
 * @method Items[]    findAll()
 * @method Items[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Items::class);
    }
    
    /**
     * @return void
     */
    public function findAllVisible()
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.isVisible = :isVisible')
            ->setParameter('isVisible', true)
            ->orderBy('q.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

        
    /**
     * @param  int $limit
     * @return void
     */
    public function findVisibleLimit(int $limit)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.isVisible = :isVisible')
            ->setParameter('isVisible', true)
            ->setMaxResults($limit)
            ->orderBy('q.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Items
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
