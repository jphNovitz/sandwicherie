<?php

namespace App\Controller\Api\Cart;


use App\Entity\Cart;
use App\Entity\Item;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use App\Service\SocketNotifier;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\FOSRestController;
use Hateoas\HateoasBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CartController extends FOSRestController
{
    protected $serializer;
    protected $customPersister;
    protected $customLoader;
    protected $em;
    protected $notifier;
    public function __construct(CustomObjectLoader $customObjectLoader,
                                CustomPersister $customPersister,
                                ContainerInterface $container,
                                EntityManagerInterface $entityManager, SocketNotifier $notifier)
    {
        $this->customPersister = $customPersister;
        $this->customLoader= $customObjectLoader;
        $this->serializer = $container->get('jms_serializer');
        $this->notifier = $notifier;
    }

    /**
     * @Post("cart", name="cart_new")
     */
    public function post(Request $request)
    {

        $cart = new Cart();
        $line = new Item();
        $box = json_decode($request->get('cart'));
        $username = $box->user;
        $user = $this->em = $this->get('doctrine.orm.entity_manager')
            ->getRepository('App:User')->loadUserByUsername($username);

            foreach ($box->items  as $item) {
               $product=$this->customLoader->LoadOne('App:Product', $item->slug);
                $line->setProduct($product);
                $line->setQuantity($item->qty);
                $cart->addItem($line);
            }

        $cart->setClient($user);

        if ($this->customPersister->insert($cart)){
            $result=$cart;
            $status = 200;
            $this->notifier->notify('notification', ['commande'=>$cart]);
        } else {
            $result = ['message'=>'erreur serveur'];
            $status = 500;
        }

        $hateoas = HateoasBuilder::create()->build();
        $json = $hateoas->serialize($result, 'json');
        $response = new Response($json, $status, array('application/json'));
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET');
        return ($response);
    }
}
