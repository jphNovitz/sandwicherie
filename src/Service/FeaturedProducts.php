<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class FeaturedProducts{
    protected $manager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    public function getFeatured(){
       return $this->manager->getRepository('App:Product')
           ->FindFeatured()
            ;
    }
    public function getLast($n){

       return $this->manager->getRepository('App:Product')
           ->FindLast($n)
            ;
    }
}