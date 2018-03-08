<?php

namespace App\Repository;

use App\Entity\UserTemp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserTempRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserTemp::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('u')
            ->where('u.something = :value')->setParameter('value', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
