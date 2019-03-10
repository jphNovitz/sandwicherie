<?php

namespace App\Controller\Api\Ingredient;

use App\Controller\Pdf\IngredientController as pdf;
use App\Entity\AllergenCloud;
use App\Entity\Allergy;
use App\Entity\Category;
use App\Entity\Ingredient;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use App\Service\IngredientPusher;
use App\Service\PrepareBuilder;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Persisters\PersisterException;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;
use Hateoas\HateoasBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IngredientController extends FOSRestController
{

    /**
     * @Route("ingredient/new", name="ingredients_api_add")
     * @Method({"POST"})
     */
    public function add(CustomPersister $persister,
                        Request $request,
                        pdf $pdf,
                        PrepareBuilder $builder,
                        IngredientPusher $pusher)
    {
        $ingredient = new Ingredient();
        $received = json_decode($request->getContent(), true);

        $properties = [
            'code', 'name', 'brands', 'generic_name_fr', 'image_ingredients_url', 'image_nutrition_url',
            'image_url', 'ingredients_text_fr', 'nutrition_grade_fr',  'nutrient_levels'
        ];

        foreach ($properties as $raw){
            if (isset($received[$raw])) {
                $property = ucfirst(implode('', array_map('ucfirst', explode('_', $raw))));
                $method = "set".ucfirst($property);
                    $ingredient->$method($received[$raw]) ;
            } ;
        }

        if (isset($received['allergens_tags'])){
            $new = $pusher->addAllergies($received['allergens_tags']);
            $ingredient->setAllergies($new);
        }

        if (isset($received['allergens_from_ingredients'])){
            $new = $pusher->addAllergenTags($received['allergens_from_ingredients']);
            $ingredient->setAllergenTags($new);
        }


        if ($new = $pusher->addCategories($received['categories'])){
            $ingredient->setCategories($new);
        }

        if (isset($received['additives_tags'])){
            $ingredient->setAdditives($received['additives_tags']);
        }
        if (isset($received['countries'])){
            $ingredient->setCountries($received['countries']);
        }

        $hateoas = HateoasBuilder::create()->build();
        if ($result = $persister->insert($ingredient)){

            $make = $pdf->index($ingredient->getSlug());
            $result =  $hateoas->serialize($make, 'json');
            $status = 200;
        } else {
            $result = ['message'=>'erreur serveur'];
            $status = 500;
        }

        $response = $builder->prepare($result, $status);
        return ($response);
    }

}
