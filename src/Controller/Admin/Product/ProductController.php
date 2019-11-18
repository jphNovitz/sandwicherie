<?php

namespace App\Controller\Admin\Product;

use App\Entity\Product ;
use App\Form\ProductType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use App\Service\DeleteObject;
use Doctrine\DBAL\Types\DateTimeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DeleteType;

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
     * @Route("", name="products_list")
     */
    public function index(Request $request)
    {
        $list = $this->get('doctrine.orm.default_entity_manager')
            ->getRepository('App:Product')
            ->myFindAll();

        if (!$list) {
            $this->addFlash('notice', "Aucun produit, je vous propose d'en ajouter un");
            return $this->redirectToRoute('products_add');
        }
        return $this->render($this->getParameter('adm_product').'/products-list.html.twig', [
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
        return $this->render($this->getParameter('adm_product').'form/product_add.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("{slug}", name="products_show")
     */
    public function show(Request $request, $slug = null)
    {
        $product = $this->customLoader->LoadOne('App:Product', $slug);
        return $this->render($this->getParameter('adm_product').'product-card.html.twig', [
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
        return $this->render($this->getParameter('adm_product').'form/product_update.html.twig', [
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("{slug}/delete", name="products_delete")
     * @Method({"GET", "POST"})
     */
    public function delete(Request $request, Product $product = NULL )
    {
        if (!$product){
            $this->addFlash("error", "produit inconnu");
            return $this->redirectToRoute('products_list');
        }
        $form = $this->createForm(DeleteType::class,null);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($form->get('oui')->isClicked()) {
                return $this->deleter->delete($product);
            }
            if ($form->get('non')->isClicked())
                return $this->redirectToRoute('products_list');

        endif;

        return $this->render('Admin/Product/form/product-delete.html.twig',
            [
                'object' => $product,
                'form' => $form->createView()
            ]);
    }
}
