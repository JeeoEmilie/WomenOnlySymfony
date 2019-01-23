<?php

namespace App\Repository;

use App\Entity\TransportType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TransportType|null find($id, $lockMode = null, $lockVersion = null)
 * @method TransportType|null findOneBy(array $criteria, array $orderBy = null)
 * @method TransportType[]    findAll()
 * @method TransportType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransportTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TransportType::class);
    }

    // /**
    //  * @return TransportType[] Returns an array of TransportType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TransportType
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
