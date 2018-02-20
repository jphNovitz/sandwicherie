<?php

namespace App\Controller\Admin\Ingredient;

use App\Entity\Ingredient ;
use App\Form\IngredientType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\SubmitButtonTypeInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\ClickableInterface;
/**
 * Class IngredientController
 * @package App\Controller\Admin\Ingredient
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
     * @Route("", name="ingredients_list")
     */
    public function index()
    {
        $list = $this->customLoader->LoadAll('App:Ingredient');
        if (!$list) {
            $this->addFlash("notice", "Il n'y a aucun ingrédient, ajoutez-en un");
            return $this->redirectToRoute("ingredients_add");
        }
        return $this->render($this->getParameter('adm_ingredient').'ingredients-list.html.twig', ['list'=>$list]);
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
        return $this->render($this->getParameter('adm_ingredient').'form/ingredient-add.html.twig', [
            'form'=>$form->createView()
        ]);
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
        return $this->render($this->getParameter('adm_ingredient').'ingredient-card.html.twig', [
            'ingredient'=>$ingredient        ]);
    }



    /**
     * @Route("{slug}/update", name="ingredients_update")
     * @Method({"GET", "POST"})
     */
    public function update(Request $request, Ingredient $ingredient= NULL )
    {
        if (!$ingredient){
            $this->addFlash("error", "ingrédient inconnu");
            return $this->redirectToRoute('ingredients_list');
        }
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->update($ingredient)){
                $this->addFlash("success", "Ingrédient modifié.");
                return $this->redirectToRoute('ingredients_update', ['slug'=>$ingredient->getSlug()]);
            } else {
                $this->addFlash("error", "Il y a eu un problème, ingredient non modifié.");
            }
        endif;
        return $this->render($this->getParameter('adm_ingredient').'form/ingredient-update.html.twig', [
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("{slug}/delete", name="ingredients_delete")
     * @Method({"GET", "POST"})
     */
    public function delete(Request $request, Ingredient $ingredient= NULL )
    {
        if (!$ingredient){
            $this->addFlash("error", "ingrédient inconnu");
            return $this->redirectToRoute('ingredients_list');
        }
        $form = $this->createFormBuilder()
            ->add('oui', SubmitType::class, ['label'=>'oui'])
            ->add('non', SubmitType::class, ['label'=>'non'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($form->get('oui')->isClicked()) {
                if ($this->customPersister->delete($ingredient)) {
                    $this->addFlash('success', 'element supprimé');
                    $this->redirectToRoute('ingredients_list');
                }
                else {
                    $this->addFlash('error', 'Erreur');
                    return $this->redirectToRoute('ingredients_list');
                }
            }
            if ($form->get('non')->isClicked())
                return $this->redirectToRoute('ingredients_list');

        endif;

        return $this->render('Admin/Ingredient/form/ingredient-delete.html.twig',
            [
                'object' => $ingredient,
                'form' => $form->createView()
                ]);
    }
}
