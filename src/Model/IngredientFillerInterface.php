<?php
namespace App\Model;

use App\Entity\Ingredient;
use App\Service\IngredientPusher;

interface IngredientFillerInterface{

    public function __construct(IngredientPusher $pusher);

    public function fill(Ingredient $ingredient, array $received);
}