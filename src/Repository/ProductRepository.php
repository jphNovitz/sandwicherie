<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query as Query;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry  $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.something = :value')->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function myFindAll(){
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getArrayResult();
    }

    public function FindAllComplete(){
        return $this->createQueryBuilder('p')
            ->leftJoin('p.images', 'images')
            ->leftJoin('p.ingredients', 'ingredients')
            ->leftJoin('ingredients.categories', 'categories')
            ->addSelect('p, images, ingredients, categories')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getArrayResult();
    }

    public function FindFeatured()
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.images', 'images')
            ->leftJoin('p.likedBy', 'l')
            ->leftJoin('p.types', 't')
            ->leftJoin('p.ingredients', 'i')
            ->addSelect('p, images, l, t, i')
            ->where('p.featured = :value')
            ->setParameter('value', true)
            ->getQuery()
           ->getArrayResult()
            ;
    }
    public function FindLast($n)
    {

        $query =  $this->createQueryBuilder('p')
            ->leftJoin('p.images', 'images')
            ->leftJoin('p.likedBy', 'l')
            ->leftJoin('p.types', 't')
            ->leftJoin('p.ingredients', 'i')
            ->addSelect('p, images, partial l.{id}, t, i')
            ->setMaxResults($n)
            ;
        return new Paginator($query);
    }

    public function findFavorites($id){
        return $this->createQueryBuilder('p')
            ->leftJoin('p.images', 'images')
            ->leftJoin('p.likedBy', 'l')
            ->leftJoin('p.types', 't')
            ->addSelect('p, images, partial l.{id}, t')
            ->andWhere('l.id = :user')
            ->setParameter('user', $id)
            ->getQuery()
            ->getArrayResult();
    }

    public function findDiscoveryList($id){
        $query =  $this->createQueryBuilder('p')
            ->leftJoin('p.images', 'images')
            ->leftJoin('p.interestedBy', 'interest')
            ->addSelect('partial p.{id,slug}, images, partial interest.{id}')
            ->andWhere('interest.id = :user')
            ->setParameter('user', $id)
            ->getQuery()
            ->setHint(Query::HINT_FORCE_PARTIAL_LOAD, 1);

        return $query->getArrayResult();
    }

    public function findVegetables(){
        return $this->createQueryBuilder('p')
            ->leftJoin('p.vegetables', 'vegetables')
            ->addSelect('vegetables')
            ->getQuery()
            ;
    }
}
