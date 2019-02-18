<?php

namespace App\Controller\Api\Ingredient;

use App\Controller\Pdf\IngredientController as pdf;
use App\Entity\Ingredient;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
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

        if (isset($received['name'])) {
            $ingredient->setName($received['name']) ;
        } ;
        if (isset($received['brands'])) {
            $ingredient->setName($received['brands']) ;
        } ;
        if (isset($received['generic_name_fr'])) {
            $ingredient->setGenericNameFr($received['generic_name_fr']);
        } ;
        if (isset($received['image_ingredients_url'])) {
            $ingredient->setGenericNameFr($received['image_ingredients_url']);
        } ;
        if (isset($received['image_nutrition_url'])) {
            $ingredient->setGenericNameFr($received['image_nutrition_url']);
        } ;
        if (isset($received['image_url'])) {
            $ingredient->setGenericNameFr($received['image_url']);
        } ;
        if (isset($received['ingredients_text_fr'])) {
            $ingredient->setGenericNameFr($received['ingredients_text_fr']);
        } ;


        $hateoas = HateoasBuilder::create()->build();
        if ($persister->insert($ingredient)){
            $make = $pdf->index($ingredient->getSlug());
            $result =  $hateoas->serialize($make, 'json');
            $status = 200;;
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
