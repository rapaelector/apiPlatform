<?php

namespace App\Repository;

use App\Entity\BuyDrink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BuyDrink|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyDrink|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyDrink[]    findAll()
 * @method BuyDrink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuyDrinkRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BuyDrink::class);
    }

    // /**
    //  * @return BuyDrink[] Returns an array of BuyDrink objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BuyDrink
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
