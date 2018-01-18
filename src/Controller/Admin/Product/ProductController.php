<?php

namespace App\Controller\Admin\Product;

use App\Entity\Product ;
use App\Form\ProductType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductController
 * @package App\Controller\Admin\Product
 * @Route("/admin/products/")
 * @Method({"GET"})
 */
class ProductController extends Controller
{
    protected $customPersister;
    protected $customLoader;

    public function __construct(CustomPersister $customPersister, CustomObjectLoader $customObjectLoader)
    {
        $this->customPersister = $customPersister;
        $this->customLoader = $customObjectLoader;
    }

    /**
     * @Route("", name="products_list")
     */
    public function index(Request $request)
    {
        $list = $this->customLoader->LoadAll('App:Product');
        if (!$list) {
            $this->addFlash('notice', 'Il n\' y a aucune catégorie, je vous propose d\'en ajouter une');
            return $this->redirectToRoute('products_add');
        }
        return $this->render('Admin/Product/products-list.html.twig', [
            'list'=>$list
        ]);
    }

    /**
     * @Route("new", name="products_add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->insert($product)):
                $this->addFlash("success", $product->getName() . " a été créé avec succès !");
             else:
                 $this->addFlash("error", $product->getName() . " n'a pas pu être ajouté");
            endif;
            return $this->redirectToRoute('products_add');
        endif;
        return $this->render('Admin/Product/form/product_add.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("{id}", name="products_show")
     */
    public function show(Request $request, $id = null)
    {
        $product = $this->customLoader->LoadOne('App:Product', $id);
        return $this->render('Admin/Product/product-card.html.twig', [
            'product'=>$product
        ]);
    }

    /**
     * @Route("{slug}/update", name="products_update")
     * @Method({"GET", "POST"})
     */
    public function update(Request $request, Product $product= NULL )
    {
        if (!$product) {
            $this->addFlash("error", "Ce produit n'existe pas ");
            return $this->redirectToRoute('products_add');
        }
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->update($product)):
                $this->addFlash("success",
                    "Le produit ". $product->getName() . " a été modifié.");
            else:
                $this->addFlash("error",
                    "Le produit ". $product->getName() . " n'a pas pu être modifié ! ");
            endif;
            return $this->redirectToRoute('products_update',[
                "slug"=>$product->getSlug()
            ]);
        endif;
        return $this->render('Admin/Product/form/product_update.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
