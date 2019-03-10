<?php

/**
 * Class IngredientPusher
 *
 * push properties in Ingredient Object but when they has to be manipulated the controller become big
 * this class help to enlighten the controller
 */

namespace App\Service;

use App\Entity\AllergenCloud;
use App\Entity\Allergy;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;
use Doctrine\ORM\ORMException;

class IngredientPusher{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }

    public function addCategories($categories = null){
        $new = [];
        if ($categories){
            foreach ($categories as $name){
                $repo = $this->entityManager
                    ->getRepository('App:Category');

                $category = $repo->findOneBy(['name' => $name]);

                if (!$category){
                    $category = new Category();
                    $category->setName($name);
                    try {
                        $this->entityManager
                            ->persist($category);
                    } catch (ORMException $e){
                        die($e);
                    }
                }
                array_push($new, $category);

            }
            return $new;
        }
        return null;
    }

    public function addAllergies($allergen_tags = null){
        $new = [];
        if ($allergen_tags){
            foreach ($allergen_tags as $tag){
                $repo = $this->entityManager
                    ->getRepository('App:Allergy');

                $allergy = $repo->findOneBy(['name' => $tag]);

                if (!$allergy){
                    $allergy = new Allergy();
                    $allergy->setName($tag);
                    try {
                        $this->entityManager
                            ->persist($allergy);
                    } catch (ORMException $e){
                        die($e);
                    }
                }
                array_push($new, $allergy);

            }
            return $new;
        }
        return null;
    }

    public function addAllergenTags($tags = null){
        $new = [];
        if ($tags){
            foreach ($tags as $tag){
                $repo = $this->entityManager
                    ->getRepository('App:AllergenCloud');

                $the_tag = $repo->findOneBy(['allergenTag' => $tag]);

                if (!$the_tag){
                    $the_tag = new AllergenCloud();
                    $the_tag->setAllergenTag($tag);
                    try {
                        $this->entityManager
                            ->persist($the_tag);
                    } catch (ORMException $e){
                        die($e);
                    }
                }
                array_push($new, $the_tag);

            }

            return $new;
        }
        return null;
    }
}