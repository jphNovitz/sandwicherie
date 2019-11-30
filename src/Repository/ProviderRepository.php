<?php

namespace App\Repository;

use App\Entity\Provider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class ProviderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry  $registry)
    {
        parent::__construct($registry, Provider::class);
    }

    public function findAll()
    {
/*
        $query = $this->createQueryBuilder('a')
            ->leftJoin('a.forbidden', 'f')
            //->leftJoin('f.ingredients', 'i')
            ->addSelect('a,f');
        return $query->getQuery()->execute();*/

        return $this->createQueryBuilder('p')
            ->select('p')
            ->getQuery()
            ->getResult()
            ;
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
