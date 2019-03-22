<?php
namespace App\Service;

use App\Entity\Ingredient;
use App\Model\IngredientFillerInterface;
use App\Model\IngredientPusherInterface;

class IngredientFiller implements  IngredientFillerInterface {

    protected $pusher;
    /**
     * $properties array contains simple properties to be added to ingredient
     * simple -> just check if they are received -> then add
     */
    protected  $properties = [
    'code', 'name', 'brands', 'generic_name_fr', 'image_ingredients_url', 'image_nutrition_url',
    'image_url', 'ingredients_text_fr', 'nutrition_grade_fr',  'nutrient_levels'
    ];

    public function __construct(IngredientPusherInterface $pusher)
    {
        $this->pusher = $pusher;
    }

    public function fill(Ingredient $ingredient, Array $received){

        /**
         * this loop check and add simple properties
         */
        foreach ($this->properties as $raw){
            if (isset($received[$raw])) {
                $property = ucfirst(implode('', array_map('ucfirst', explode('_', $raw))));
                $method = "set".ucfirst($property);
                $ingredient->$method($received[$raw]) ;
            } ;
        }

        /**
         * the following properties are more complex to add
         * here i use a servie (IngredientPusher $pusher)
         */

        if (isset($received['allergens_tags'])){
            $new = $this->pusher->addAllergies($received['allergens_tags']);
            $ingredient->setAllergies($new);
        }

        if (isset($received['allergens_from_ingredients']) && !empty($received['allergens_from_ingredients'])){
            $new = $this->pusher->addAllergenTags($received['allergens_from_ingredients']);
            $ingredient->setAllergenTags($new);
        }


        if ($new = $this->pusher->addCategories($received['categories'])){
            $ingredient->setCategories($new);
        }

        if (isset($received['additives_tags'])){
            $ingredient->setAdditives($received['additives_tags']);
        }
        if (isset($received['countries'])){
            $ingredient->setCountries($received['countries']);
        }

        return $ingredient;

    }
}