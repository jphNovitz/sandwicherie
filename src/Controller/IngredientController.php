<?php

namespace App\Controller;

use App\Entity\Ingredient ;
use App\Form\IngredientType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class IngredientController
 * @package App\Controller
 * @Route("/admin/ingredients/")
 * @Method({"GET"})
 */
class IngredientController extends Controller
{
    protected $customPersister;
    protected $customLoader;

    public function __construct(CustomPersister $customPersister, CustomObjectLoader $customObjectLoader)
    {
        $this->customPersister = $customPersister;
        $this->customLoader = $customObjectLoader;
    }

    /**
     * @Route("new", name="ingredients_add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request)
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if($this->customPersister->insert($ingredient)) {
                $this->addFlash("success",
                    "Votre ingrédient ".$ingredient->getName()." a bien été ajouté.");
            } else {
                $this->addFlash("error",
                    "l'ingrédient n'a pas pu être ajouté.");
            }
        endif;
        return $this->render('Ingredient/ingredient_add.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("", name="ingredients_list")
     */
    public function index()
    {
        $list = $this->customLoader->LoadAll('App:Ingredient');
        if (!$list) {
            $this->addFlash("notice", "Il n'y a aucun ingrédient, ajoutez-en un");
            return $this->redirectToRoute("ingredients_add");
        }
        return $this->render('Ingredient/ingredients-list.html.twig', ['list'=>$list]);
    }

    /**
     * @Route("{id}", name="ingredients_show")
     */
    public function show(Request $request, $id = null)
    {
        $ingredient = $this->customLoader->LoadOne('App:Ingredient', $id);
        if (!$ingredient){
            $this->addFlash("error", "ingrédient inconnu");
            return $this->redirectToRoute('ingredients_list');
        }
        return $this->render('Ingredient/ingredient-card.html.twig', [
            'ingredient'=>$ingredient        ]);
    }



    /**
     * @Route("{slug}/update", name="ingredients_update")
     */
    public function update(Request $request, Ingredient $ingredient= NULL )
    {

        if (!$ingredient) {
            return new Response('To do: renvoyer vers une page');
        }
        $form = $this->createForm(IngredientType::class, $ingredient);
        return $this->render('Ingredient/ingredient-update.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
