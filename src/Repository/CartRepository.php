<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CartRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function findAllOrders(){
        return $this->createQueryBuilder('c')
            ->addSelect('partial c.{id}')
             ->leftJoin('c.items', 'items')
             ->addSelect('partial items.{id, halal, bread, vegetables}')
             ->leftJoin('items.product', 'prod')
             ->addSelect('partial prod.{id, slug, name, price}')
             ->leftJoin('c.client', 'client')
             ->addSelect('partial client.{id, username, firstName, lastName, phone, email, street, streetNr, city}')
            ->andWhere('c.done = true')
            ->addOrderBy('c.created', 'ASC')
            ->getQuery()
            ->getArrayResult()
            ;

    }

    public function findOrdersByUser($username){
        return $this->createQueryBuilder('c')
            ->leftJoin('c.items', 'items')
            ->addSelect('c, items')
            ->getQuery()
            ->getResult();
    }
    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('c')
            ->where('c.something = :value')->setParameter('value', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
