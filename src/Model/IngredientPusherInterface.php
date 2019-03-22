<?php

namespace App\Model;

use Doctrine\ORM\EntityManagerInterface;

interface IngredientPusherInterface{

    public function __construct(EntityManagerInterface $entityManager);
    public function addCategories(Array $categories = null);
    public function addAllergies(Array $allergen_tags = null);
    public function addAllergenTags(Array $tags = null);

}