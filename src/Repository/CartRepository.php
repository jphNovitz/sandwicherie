<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
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
             ->addSelect('items')
             ->leftJoin('items.product', 'prod')
             ->addSelect('partial prod.{id, slug, name, price}')
             ->leftJoin('c.client', 'client')
             ->addSelect('partial client.{id, username, firstName, lastName, phone, email, street, streetNr, city}')
            ->addOrderBy('c.created', 'ASC')
            ->getQuery()
            ->getArrayResult()
            ;

    }

    public function findAllPending(){
        return $this->createQueryBuilder('c')
        ->addSelect('partial c.{id, done}')
            ->leftJoin('c.items', 'items')
            ->addSelect('items')
            ->leftJoin('items.product', 'prod')
            ->addSelect('partial prod.{id, slug, name, price}')
            ->leftJoin('c.client', 'client')
            ->addSelect('partial client.{id, username, firstName, lastName, phone, email, street, streetNr, city}')
            ->andWhere('c.done = false')
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

    public function findOrderWithItems($id){
        return $this->createQueryBuilder('c')
            ->leftJoin('c.items', 'items')
            ->addSelect('c, items')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()[0];
    }
    public function findOrderByUser($username){
        return $this->createQueryBuilder('c')
            ->leftJoin('c.items', 'items')
            ->addSelect('c, items')
            ->andWhere('c.status = :status')
            ->setParameter('status', 'En cours')
            ->addOrderBy('c.id', 'DESC')
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function countCartItemsByUser($username){

       $query =  $this->createQueryBuilder('c')
            ->leftJoin('c.items', 'items')
            ->leftJoin('c.client', 'client')
            ->andWhere('client.username = :username')
            ->setParameter('username', $username)
            ->andWhere('c.status = :status')
            ->setParameter('status', 'En cours')
            ->addselect('count(items.id)')
            ->addGroupBy('c')
            ->select('count(items)')
            ->getQuery();
       try {
           return $query->getSingleScalarResult();
       }catch (ORMException $e){
           return 0;
       }

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
