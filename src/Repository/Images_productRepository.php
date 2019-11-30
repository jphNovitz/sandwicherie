<?php

namespace App\Repository;

use App\Entity\Imagesproduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class Images_productRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry  $registry)
    {
        parent::__construct($registry, Imagesproduct::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('i')
            ->where('i.something = :value')->setParameter('value', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
