<?php

namespace App\Repository;

use App\Entity\Card;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Card|null find($id, $lockMode = null, $lockVersion = null)
 * @method Card|null findOneBy(array $criteria, array $orderBy = null)
 * @method Card[]    findAll()
 * @method Card[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Card::class);
    }

    /**
    * @return Card[] Returns an array of Card objects
    */   
    public function findCardByUserAndCommerceId($user, $commerce)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.commerce = :commerce')
            ->andWhere('c.user = :user')
            ->setParameter('commerce', $commerce)
            ->setParameter('user', $user)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Card[] Returns an array of Card objects
    */   
    public function findCardsByCommerceId($commerce)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.commerce = :commerce')        
            ->setParameter('commerce', $commerce)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Card
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
