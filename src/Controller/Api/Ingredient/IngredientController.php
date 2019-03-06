<?php

namespace App\Controller\Api\Ingredient;

use App\Controller\Pdf\IngredientController as pdf;
use App\Entity\AllergenCloud;
use App\Entity\Allergy;
use App\Entity\Category;
use App\Entity\Ingredient;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
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
    public function add(CustomPersister $persister, Request $request, pdf $pdf)
    {
        $ingredient = new Ingredient();
        $received = json_decode($request->getContent(), true);


        if (isset($received['code'])) {
            $ingredient->setCode($received['code']) ;
        } ;
        if (isset($received['name'])) {
            $ingredient->setName($received['name']) ;
        } ;
        if (isset($received['brands'])) {
            $ingredient->setBrands($received['brands']) ;
        } ;
        if (isset($received['generic_name_fr'])) {
            $ingredient->setGenericNameFr($received['generic_name_fr']);
        } ;
        if (isset($received['image_ingredients_url'])) {
            $ingredient->setImageIngredientsUrl($received['image_ingredients_url']);
        } ;
        if (isset($received['image_nutrition_url'])) {
            $ingredient->setImageNutritionUrl($received['image_nutrition_url']);
        } ;
        if (isset($received['image_url'])) {
            $ingredient->setImageUrl($received['image_url']);
        } ;
        if (isset($received['ingredients_text_fr'])) {
            $ingredient->setIngredientsTextFr($received['ingredients_text_fr']);
        } ;
        if (isset($received['allergens_tags'])) {
            foreach ($received['allergens_tags'] as $tag) {
                $repo = $this->get('doctrine.orm.default_entity_manager')->getRepository('App:Allergy');
                $allergy = $repo->findOneBy(['name' => $tag]);
                if (!$allergy){
                    $allergy = new Allergy();
                    $allergy->setName($tag);
                }
                $ingredient->addAllergy($allergy);
            }
        } ;
        if (isset($received['allergens_from_ingredients'])) {
            foreach ($received['allergens_from_ingredients'] as $t) {
                $repo = $this->get('doctrine.orm.default_entity_manager')->getRepository('App:AllergenCloud');
                $tag = $repo->findOneBy(["allergenTag" =>$t]);

                if (!$tag){
                    $tag = new AllergenCloud();
                    $tag->setAllergenTag($t);
                    try {
                        $this->get('doctrine.orm.default_entity_manager')->persist($tag);
                    } catch (ORMException $e){
                        die($e);
                    }
                }
                $ingredient->addAllergenTag($tag);
            }
        }

        if (isset($received['nutrition_grade_fr'])){
            $ingredient->setNutritionGradeFr($received['nutrition_grade_fr']);
        }
        if (isset($received['categories'])){
            foreach ($received['categories'] as $name){
                $repo = $this->get('doctrine.orm.default_entity_manager')
                    ->getRepository('App:Category');
                $category = $repo->findOneBy(['name' => $name]);

                if (!$category){
                    $category = new Category();
                    $category->setName($name);
                    try {
                        $this->get('doctrine.orm.default_entity_manager')
                            ->persist($category);
                    } catch (ORMException $e){
                        die($e);
                    }
                }
                $ingredient->addCategory($category);
            }
        }

        if (isset($received['nutrient_levels'])){
            $ingredient->setNutrientLevels($received['nutrient_levels']);
        }

        if (isset($received['additives_tags'])){
            $ingredient->setAdditives($received['additives_tags']);
        }
        if (isset($received['countries'])){
            $ingredient->setCountries($received['countries']);
        }

        $hateoas = HateoasBuilder::create()->build();
        if ($persister->insert($ingredient)){
            $make = $pdf->index($ingredient->getSlug());
            $result =  $hateoas->serialize($make, 'json');
            $status = 200;
        } else {
            $result = ['message'=>'erreur serveur'];
            $status = 500;
        }

        $response = $this->prepare($result, $status);
        return ($response);
    }

    protected function prepare($result, $status){
        $hateoas = HateoasBuilder::create()->build();
        $json = $hateoas->serialize($result, 'json');
        $response = new Response($json, $status, array('application/json'));
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET');
        return $response;
    }
}
