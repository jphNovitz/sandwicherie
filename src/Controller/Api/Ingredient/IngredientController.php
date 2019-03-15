<?php
/**
 * Ingredient Controller (api)
 * receive an array of values
 * add each one to Ingredient Object then persist it
 *
 * create a PDF document and return a response
 *
 * @author novitz Jean-Philippe <novitz@gmail,com>
 * @version 1.0
 * 2019
 */

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


/**
 * Class IngredientController
 * @package App\Controller\Api\Ingredient
 */
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

        /**
         * $properties array contains simple properties to be added to ingredient
         * simple -> just check if they are received -> then add
         */
        $properties = [
            'code', 'name', 'brands', 'generic_name_fr', 'image_ingredients_url', 'image_nutrition_url',
            'image_url', 'ingredients_text_fr', 'nutrition_grade_fr',  'nutrient_levels'
        ];

        /**
         * this loop check and add simple properties
         */
        foreach ($properties as $raw){
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
            $new = $pusher->addAllergies($received['allergens_tags']);
            $ingredient->setAllergies($new);
        }

        if (isset($received['allergens_from_ingredients']) && !empty($received['allergens_from_ingredients'])){
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

        /**
         *  in the following lines
         *      - the ingredient is persisted
         *      - a pdf document is generatd
         *      - the response is
         *          - created
         *           - prepared using the PrepareBuilder $builder service
         *           - returned
         */

        $hateoas = HateoasBuilder::create()->build();
        if ($result = $persister->insert($ingredient)){
            $result_persist = 'success';
            $message_persist = 'Le produit a été enregistré';
            $persist = [
                'persist' => [
                    'result' => $result_persist
//                    ,
//                    'message' => $message_persist
                ]];
            // make receive a slug of false
            if($make = $pdf->create($ingredient->getSlug())){
                $pdf = [
                    'result' => 'success'
                    ,
                    'message' => 'Un PDF a été créé'
                ];
            } else {
                $pdf = [
                    'result' => 'error',
                    'message' => 'Le PDF n\'a pas pu être créé'
                ];
            }
            $result =  $hateoas->serialize(['persist' => $persist, 'pdf' => $pdf], 'json');
            $status = 200;
        } else {
            $result_persist = 'error' ;
            $message_persist = 'Le produit n\'a pas pu  être enregistré';
            $persist = ['persist' => [
                'result' => $result_persist,
                'message' => $message_persist
            ]];
//            $result = ['message'=>'erreur serveur'];
            $status = 500;
        }
        $response = $builder->prepare($result, $status);
//        echo '<pre>';
//        dump($result); die();
//        echo '</pre>';
        return ($response);
    }

}
