<?php
namespace App\Model;

use App\Entity\Ingredient;

interface IngredientFillerInterface{

    public function __construct(IngredientPusherInterface $pusher);

    public function fill(Ingredient $ingredient, array $received);
}