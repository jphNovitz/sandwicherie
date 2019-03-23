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
use App\Entity\Ingredient;
use App\Model\IngredientFillerInterface;
use App\Model\PrepareBuilderInterface;
use App\Service\CustomPersister;
use FOS\RestBundle\Controller\FOSRestController;
use Hateoas\HateoasBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
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
    public function add(IngredientFillerInterface $filler,
                        CustomPersister $persister,
                        Request $request,
                        pdf $pdf,
                        PrepareBuilderInterface $builder)
    {
        $received = json_decode($request->getContent(), true);
        if (!$ingredient = $this->get('doctrine.orm.default_entity_manager')
            ->getRepository('App:Ingredient')
            ->findOneBy(['code'=>$received['code']])
        ){
            $ingredient = new Ingredient();
        }

        $ingredient = $filler->fill($ingredient, $received);

        $hateoas = HateoasBuilder::create()->build();
        if ($ingredient->getId()) {
            $action = 'update';
        } else {
            $action = 'insert';
        }
        if ($result = $persister->$action($ingredient)){

            $result_persist = 'success';
            $message_persist = 'Le produit a été enregistré';
            $persist = [
                    'result' => $result_persist,
                    'message' => $message_persist,
                    'slug' => $ingredient->getSlug()
                ];
            // make receive a slug of false
            if($make = $pdf->create($ingredient->getSlug())){
                $ingredient->setPdf(true);
                $persister->update($ingredient);
                $pdf = [
                    'result' => 'success',
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
        return ($response);
    }
}