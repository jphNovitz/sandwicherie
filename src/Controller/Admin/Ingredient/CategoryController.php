<?php

namespace App\Controller\Admin\Ingredient;

use App\Entity\Category ;
use App\Form\CategoryType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use App\Service\DeleteObject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DeleteType;

/**
 * Class CategoryController
 * @package App\Controller\Admin\Ingredient
 * @Route("/admin/categories/")
 * @Method({"GET"})
 */
class CategoryController extends Controller
{
    protected $customPersister;
    protected $customLoader;
    protected $deleter;

    public function __construct(CustomPersister $customPersister,
                                CustomObjectLoader $customObjectLoader,
                                DeleteObject $deleter)
    {
        $this->customPersister = $customPersister;
        $this->customLoader = $customObjectLoader;
        $this->deleter = $deleter;
    }

    /**
     * @Route("new", name="categories_add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->insert($category)):
                $this->addFlash("success",
                    "La catégorie ". $category->getName() . " a été créée avec succès !");
             else:
                 $this->addFlash("error",
                        "La catégorie ". $category->getName() . " n'a pas pu être ajoutée");
            endif;
            return $this->redirectToRoute('categories_add');
        endif;
        return $this->render('Admin/Ingredient/Category/form/category_add.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("", name="categories_list")
     */
    public function index(Request $request)
    {
        $list = $this->customLoader->LoadAll('App:Category');
        if (!$list) {
            $this->addFlash('notice', 'Il n\' y a aucune catégorie, je vous propose d\'en ajouter une');
            return $this->redirectToRoute('categories_add');
        }
        return $this->render('Admin/Ingredient/Category/categories-list.html.twig', [
            'list'=>$list
        ]);
    }

    /**
     * @Route("{slug}", name="categories_show")
     */
    public function show(Request $request, $slug = null)
    {
        $category = $this->customLoader->LoadOne('App:Category', $slug);
        return $this->render('Admin/Ingredient/Category/category-card.html.twig', [
            'category'=>$category
        ]);
    }



    /**
     * @Route("{slug}/update", name="categories_update")
     * @Method({"GET", "POST"})
     */
    public function update(Request $request, Category $category= NULL )
    {
        if (!$category) {
            $this->addFlash("error", "Cette categorie n'existe pas ");
            return $this->redirectToRoute('categories_add');
        }
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->update($category)):
                $this->addFlash("success",
                    "La catégorie ". $category->getName() . " a été modifiée !");
            else:
                $this->addFlash("error",
                    "La catégorie ". $category->getName() . " n'a pas pu être modifiée ");
            endif;
            return $this->redirectToRoute('categories_update',[
                "slug"=>$category->getSlug()
            ]);
        endif;
        return $this->render('Admin/Ingredient/Category/form/category_update.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("{slug}/delete", name="categories_delete")
     * @Method({"GET", "POST"})
     */
    public function delete(Request $request, Category $category= NULL )
    {
        if (!$category){
            $this->addFlash("error", "categorie inconnue");
            return $this->redirectToRoute('categories_list');
        }
        $form = $this->createForm(DeleteType::class,null);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($form->get('oui')->isClicked()) {
                return $this->deleter->delete($category);
       }
            if ($form->get('non')->isClicked())
                return $this->redirectToRoute('categories_list');

        endif;

        return $this->render('Admin/Ingredient/Category/form/category-delete.html.twig',
            [
                'object' => $category,
                'form' => $form->createView()
            ]);
    }
}
