<?php

namespace App\Controller\Admin\Cart;

use App\Entity\Cart;
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

class CartController extends Controller{

    /**
     * @Route("/cart", name="cart_default")
     */
    public function index(Request $request){
        $form = $this->createFormBuilder()
            ->add('test', ChoiceType::class,['choices'=>['saucisse'=>'saucisse', 'hamburger'=>'hamburger' ]])->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $test = $form->getData()['test'];
            $client = new Client(new Version2X('http://localhost:3000'));
            $client->initialize();
            $client->emit('notification', ['notification'=>$test]);
            $client->close();
            return $this->redirectToRoute('cart_default');
        }
        return $this->render('form.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/cart/{id}", name="carts_show")
     */
    public function show(Cart $cart){
        if (!$cart){
            $this->addFlash("error", "cette commande n'esiste pas ");
            return $this->redirectToRoute('cart_default');
        }

        die('ajouter cart template');
    }


    /**
     * @Route("/cart/{id}/done", name="cart_done")
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