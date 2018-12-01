<?php

namespace App\Repository;

use App\Entity\Mixture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Mixture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mixture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mixture[]    findAll()
 * @method Mixture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MixtureRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mixture::class);
    }

    // /**
    //  * @return Mixture[] Returns an array of Mixture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mixture
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
