<?php

namespace App\Repository;

use App\Entity\AllergenCloud;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AllergenCloud|null find($id, $lockMode = null, $lockVersion = null)
 * @method AllergenCloud|null findOneBy(array $criteria, array $orderBy = null)
 * @method AllergenCloud[]    findAll()
 * @method AllergenCloud[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AllergenCloudRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AllergenCloud::class);
    }

//    /**
//     * @return AllergenCloud[] Returns an array of AllergenCloud objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AllergenCloud
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
