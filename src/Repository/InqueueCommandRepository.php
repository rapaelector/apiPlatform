<?php

namespace App\Repository;

use App\Entity\InqueueCommand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InqueueCommand|null find($id, $lockMode = null, $lockVersion = null)
 * @method InqueueCommand|null findOneBy(array $criteria, array $orderBy = null)
 * @method InqueueCommand[]    findAll()
 * @method InqueueCommand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InqueueCommandRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InqueueCommand::class);
    }

    // /**
    //  * @return InqueueCommand[] Returns an array of InqueueCommand objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InqueueCommand
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
