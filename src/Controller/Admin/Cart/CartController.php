<?php

namespace App\Controller\Admin\Cart;

use App\Entity\Cart;
use App\Form\CartType;
use App\Model\CustomObjectLoaderInterface;
use App\Model\CustomPersisterInterface;
use App\Service\CustomPersister;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Mapping\Annotation;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter;


/**
 * Class CartController
 * @package App\Controller\Admin\Cart
 * @Route("/admin/cart/")
 * @Method({"GET"})
 */
class CartController extends Controller{

    protected $loader ;
    protected $persister;

    public function __construct(CustomObjectLoaderInterface $loader, CustomPersisterInterface $persister)
    {
        $this->loader = $loader;
        $this->persister = $persister;
    }

    /**
     * @Route("new", name="carts_create")
     * @Method({"GET","POST"})
     */
    public function new(Request $request){
        $cart = new Cart();

        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()):
            foreach ($cart->getItems() as $item){
                $price = $item->getProduct()->getPrice();
                $item->setPrice($price);
            }

            if ($this->persister->insert($cart)){
                $this->addFlash('success', 'Commande ajoutée ');
                return $this->redirectToRoute('carts_create');
            }
            $this->addFlash('error', 'Problème avec la commande ');
            return $this->redirectToRoute('carts_list');
        endif;

        return $this->render('Admin/Cart/form/cart_add.html.twig', [
            'form'=>$form->createView()
        ]);

    }


    /**
     * @Route("", name="carts_list")
     */
    public function list(){
        $list = $this->loader->LoadAll('App:Cart');

        if (!$list){
            $this->addFlash("error", "Aucun commande trouvée ");
            return $this->redirectToRoute('admin_default');
        }

        return $this->render('Admin/Cart/carts-list.html.twig', [
            'list'=>$list
        ]);

    }

    /**
     * @Route("{id}", name="carts_show")
     */
    public function show(Cart $cart){

        if (!$cart){
            $this->addFlash("error", "Commande non trouvée ");
            return $this->redirectToRoute('carts_list');
        }
        return $this->render('Admin/Cart/cart-card.html.twig', [
            'cart'=>$cart
        ]);
    }



    /**
     * @Route("{id}/update", name="carts_update")
     * @Method({"GET", "PUT"})
     */
    public function update(Request $request, Cart $cart=null){

        if (!$cart){
            $this->addFlash('error', 'Commande non trouvée !');
            return $this->redirectToRoute('carts_list');
        }

        $form = $this->createForm(CartType::class, $cart, [
            'method'=>'PUT'
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()):
            foreach ($cart->getItems() as $item){
                $price = $item->getProduct()->getPrice();
                $item->setPrice($price);
            }

            if ($this->persister->insert($cart)){
                $this->addFlash('success', 'Commande ajoutée ');
                return $this->redirectToRoute('carts_create');
            }
            $this->addFlash('error', 'Problème avec la commande ');
            return $this->redirectToRoute('carts_list');
        endif;

        return $this->render('Admin/Cart/form/cart_update.html.twig', [
            'form'=>$form->createView()
        ]);



    }

    /**
     * @Route("{id}/delete", name="carts_delete")
     */
    public function delete(){

    }



    /**
     * @Route("{id}/done", name="cart_done")
     * @Method({"PATCH"})
     */
     public function setDone(Cart $cart){

         $response = new JsonResponse();
         try {
             $em = $this->get('doctrine.orm.default_entity_manager');
             if ($cart->isDone()){
                 $cart->setDone(false);
                 $flag = false ;
             } else {
                 $cart->setDone(true);
                 $flag = true ;
             }
             $em->persist($cart);
             $em->flush();
             $response->setStatusCode(200);
             $response->setData($flag);
             return  $response;
         } catch (\Exception $e){
             $response->setStatusCode(500);
             return  $response;
         }


    }
}