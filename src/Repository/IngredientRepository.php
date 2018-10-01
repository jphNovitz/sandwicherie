<?php

namespace App\Repository;

use App\Entity\Ingredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class IngredientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ingredient::class);
    }

    public function findAll()
    {
        return $this->createQueryBuilder('i')
            ->leftJoin('i.categories', 'categories')
            ->leftJoin('i.components', 'components')
            ->leftJoin('i.images', 'images')
            ->addSelect('i, categories, components, images')
            ->getQuery()->getResult();
    }

    // this function is used in the productType form
    public function findGeneralIngredients()
    {
        return $this->createQueryBuilder('i')
            ->where('i.vegetable = :value')->setParameter('value', false)
            ->andWhere('i.bread = :value')->setParameter('value', false)
            ->andWhere('i.sauce = :value')->setParameter('value', false)
            ->orderBy('i.slug', 'ASC')

            ;
    }

    // this function is used in the productType form
    public function findVegetables()
    {
        return $this->createQueryBuilder('i')
            ->where('i.vegetable = :value')->setParameter('value', true)
            ->orderBy('i.slug', 'ASC')

            ;
    }

    // this function is used in the productType form
    public function findBreads()
    {
        return $this->createQueryBuilder('i')
            ->where('i.bread = :value')->setParameter('value', true)
            ->orderBy('i.slug', 'ASC')

            ;
    }


    // this function is used in the productType form
    public function findSauces()
    {
        return $this->createQueryBuilder('i')
            ->where('i.sauce = :value')->setParameter('value', true)
            ->orderBy('i.slug', 'ASC')

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
