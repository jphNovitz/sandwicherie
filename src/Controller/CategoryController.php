<?php

namespace App\Controller;

use App\Entity\Category ;
use App\Form\CategoryType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class CategoryController extends Controller
{
    protected $customPersister;
    protected $customLoader;

    public function __construct(CustomPersister $customPersister, CustomObjectLoader $customObjectLoader)
    {
        $this->customPersister = $customPersister;
        $this->customLoader = $customObjectLoader;
    }

    /**
     * @Route("/category/new", name="category_add")
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
            return $this->redirectToRoute('category_add');

        endif;
        return $this->render('Category/category_add.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("/categories", name="categories_list")
     */
    public function index(Request $request)
    {
        $list = $this->customLoader->LoadAll('App:Category');
        if (!$list) {
            $this->addFlash('notice', 'Il n\' y a aucune catégorie, je vous propose d\'en ajouter une');
            return $this->redirectToRoute('category_add');
        }
        return $this->render('Category/categories-list.html.twig', [
            'list'=>$list
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_show")
     */
    public function show(Request $request, $id = null)
    {
        $category = $this->customLoader->LoadOne('App:Category', $id);
        return $this->render('Category/category-card.html.twig', [
            'category'=>$category
        ]);
    }



    /**
     * @Route("/category/{slug}/update", name="category_update")
     */
    public function update(Request $request, Category $category= NULL )
    {
        if (!$category) {
            $this->addFlash("error", "Cette categorie n'existe pas ");
            return $this->redirectToRoute('category_add');
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
            return $this->redirectToRoute('category_update',[
                "slug"=>$category->getSlug()
            ]);
        endif;
        return $this->render('Category/category_update.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
