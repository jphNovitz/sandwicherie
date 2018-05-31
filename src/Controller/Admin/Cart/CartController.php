<?php

namespace App\Controller\Admin\Cart;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Mapping\Annotation;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

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
}