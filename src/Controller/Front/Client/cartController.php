<?php

namespace App\Controller\Front\Client;

use App\Entity\Cart;
use App\Entity\Item;
use App\Entity\User;
use App\Form\CartType;
use App\Form\ItemType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class cartController extends AbstractController {

    /**
     * @Route("mon-panier", name="front_get_user_Cart")
     */
    public function currentCart(Request $request){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $cart = $this->get('doctrine.orm.default_entity_manager')
            ->getRepository('App:Cart')
            ->findOrderByUser($this->getUser());

        return $this->render('Front/Client/cart_undone.html.twig', [
            'cart' => $cart
        ]);
    }

    /**
     * @route("mon-panier/delete", name="front_remove_cart_item", methods={"POST"})
     *
     */
    public function deleteItem(Request $request, CustomPersister $persister){

        $cart_id = $request->request->get('cart');
        $item_id = $request->request->get('item');
        $manager = $this->get('doctrine.orm.default_entity_manager');

        $cart = $manager->getRepository('App:Cart')->findOrderWithItems($cart_id);
        $item = $manager->getRepository('App:Item')->findOneBy(['id'=>$item_id]);

        $cart->removeItem($item);
        if ($persister->update($cart)) $this->addFlash('succes', 'Element supprimé');
            else $this->addFlash('error', 'Erreur');
//        dump($item);
//        dump($cart);die();
        return $this->redirectToRoute('front_get_user_Cart');
    }

    /**
     * @Route("/llml", name="get_cart_size")
     */
    public function getCartNumber(CustomObjectLoader $loader){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $username = $user->getUsername();
        $repo = $this->get('doctrine.orm.default_entity_manager')->getRepository('App:Cart');
        $nb = $repo->countCartItemsByUser($username);

        return new Response($nb);
    }

    /**
     * @Route("/cart/{id}/validate", name="front_cart_validate")
     */
    public function validate(Request $request, Cart $cart, CustomPersister $persister){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if (!$user = $this->getUser()) {
            $this->addFlash('error', 'ce panier est vide');
        }

        $cart->setStatus('Validé');

        if (!$persister->update($cart)) {
            $this->addFlash("error", "une erreur s'est produite" );
        } else {
            $this->addFlash("success", "Commande Validé, elle on s'en occupe le plus vite possivle, sisi promis !");
        }

        return $this->redirectToRoute('front_get_user_Cart');

    }

    /**
     * @Route("/cart/{id}/abandon", name="front_cart_abandon")
     */
    public function abandon(Request $request, Cart $cart, CustomPersister $persister){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if (!$user = $this->getUser()) {
            $this->addFlash('error', 'ce panier est vide');
        }

        $cart->setStatus('Abandonné');

        if (!$persister->update($cart)) {
            $this->addFlash("error", "une erreur s'est produite" );
        } else {
            $this->addFlash('success', 'Commande abandonnée');
        }

        return $this->redirectToRoute('front_get_user_Cart');

    }

//    /**
//     * @Route("cart/add", name="add_item", methods={"GET", "POST"})
//     */
//    public function addItemToCart(Request $request){
//        $user = $this->getUser();
//        $item = new Item();
////        $repo = $this->get('doctrine.orm.default_entity_manager')->getRepository('App:Cart');
////        $repo = $this->get('doctrine.orm.default_entity_manager')->getRepository('App:Cart');
////        $cart = $repo->findOneBy(['client'=>$user]);
//
////        if (!$cart) $cart = new Cart();
//
//        $form = $this->createForm(ItemType::class,$item);
//
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()){
//            die();
//        }
//        return $this->render('Front/Client/cart_form_add.html.twig', ['form'=>$form->createView()]);
//
//    }


}