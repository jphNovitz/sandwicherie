<?php

namespace App\Controller\Front\Product;

use App\Entity\Cart;
use App\Entity\Item;
use App\Entity\Product;
use App\Form\ItemType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use App\Service\FeaturedProducts;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;


class productController extends AbstractController {

     protected $container;

     public function __construct(ContainerInterface $container)
     {
         $this->container = $container;
     }

    /**
     * @Route("/la-carte/{type}", name="front_products_list", schemes={"https"})
     */
    public function index(Request $request, CustomObjectLoader $loader, ContainerInterface $container, $type=null){

        $cache = new FilesystemAdapter();
        $cache->expiresAfter(DateInterval::createFromDateString('1 day'));
//        $cache->delete('list_'.$type);die();
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        if ($type) {
            $list_products = $cache->get('list_' . $type, function () use ($type) {
                return $this->getListProducts($type);
            });
        }else {
            $list_products = $cache->get('list_products', function () {
                return $this->getListProducts();
            });
        }

            $list_allergies = $cache->get('list_allergiesWithCategories', function(){
                return $this->getAllergiesWithCategories();
            });

        if (empty($list_products)){
            $this->addFlash('error', 'cette catégorie n\'existe pas');
            return $this->redirectToRoute('front_products_list');
        }
        if (!$type) $type='sandwiches';
       return $this->render('Front/Product/products-list.html.twig', [
           'list_products' => $serializer->serialize($list_products, 'json'),
           'list_allergies' => $serializer->serialize($list_allergies, 'json'),
           'type' =>  ucfirst($type)
       ]);

    }

    /**
     * @Route("/detail-produit/{slug}", name="product_card", schemes={"https"})
     */
    public function show(Request $request, Product $product = null, CustomPersister $persister){
        if (!$product){
            $this->addFlash('Error', "Ce produits n'existe pas" );
            return $this->redirectToRoute('front_products_list');
        }
        $user = $this->getUser();
        /*  form part */
        $item = new Item();
        $form = $this->makeForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
        $item = $form->getData();
            if ($form['mode']->getData() == 'sur place')
                $item->setPrice($product->getPrice()+.5);
                else
                    $item->setPrice($product->getPrice());

        $cart = $this->get('doctrine.orm.default_entity_manager')
            ->getRepository('App:Cart')
            ->findOrderByUser($user);


        if (!$cart) {
            $new = true;
            $cart = new Cart();
        } else $new = false;

        $item->setProduct($product);
        $cart->addItem($item);
        $cart->setClient($user);

            $new ? $persister->insert($cart) : $persister->update($cart);

            $this->addFlash('success', 'Votre produit a été ajouté au panier');
            if($form->get('continue')->isClicked()){
                return $this->redirectToRoute('front_products_list');
            } elseif($form->get('basket')->isClicked()){
                return $this->redirectToRoute('front_get_user_Cart');
            }
        }
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        return $this->render('Front/Product/product-card.html.twig', [
           'product' => $product,
            'images' => $serializer->serialize($product->getImages(), 'json'),
            'form' => $form->createView()
        ]);
    }

    protected function makeForm(){
        $item = new Item();
        return $this->createForm(ItemType::class,$item);
    }

    protected function getListProducts($type='salades'){

//        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        return $this->getDoctrine()->getManager()
            ->getRepository('App:Product')
            ->findAllComplete($type);

    }
    protected function getAllergiesWithCategories(){
        return $this->getDoctrine()->getManager()
            ->getRepository('App:Allergy')
            ->findAllWithCategories();

    }
}
