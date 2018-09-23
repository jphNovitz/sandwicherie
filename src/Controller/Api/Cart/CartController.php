<?php

namespace App\Controller\Api\Cart;


use App\Entity\Cart;
use App\Entity\Item;
use App\Model\CustomPersisterInterface;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use App\Service\SocketNotifier;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\FOSRestController;
use Hateoas\HateoasBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ZMQ;
use ZMQContext;


class CartController extends FOSRestController
{
    protected $serializer;
    protected $customPersister;
    protected $customLoader;
    protected $em;
    protected $notifier;
    public function __construct(CustomObjectLoader $customObjectLoader,
                                CustomPersisterInterface $customPersister,
                                ContainerInterface $container,
                                EntityManagerInterface $entityManager, SocketNotifier $notifier)
    {
        $this->customPersister = $customPersister;
        $this->customLoader= $customObjectLoader;
        $this->serializer = $container->get('jms_serializer');
        $this->notifier = $notifier;
        $this->em = $entityManager;
    }

    /**
     * @Get("orders", name="orders_list")
     */
    public function list(Request $request) {
        $result =  $this->get('doctrine.orm.default_entity_manager')
                ->getRepository('App:Cart')
                ->findAllOrders();
        $status = 200;
        $hateoas = HateoasBuilder::create()->build();
        $json = $hateoas->serialize($result, 'json');
        $response = new Response($json, $status, array('application/json'));
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET');
        return ($response);
    }

    /**
     * @Post("cart", name="cart_new")
     */
    public function post(Request $request)
    {

        $cart = new Cart();
    //  $box = json_decode($request->request->get('cart'));
//       dump($request->request);die();
       $box = json_decode($request->getContent(), true);
        $username = $box['user'];

        $user = $this->em = $this->get('doctrine.orm.entity_manager')
            ->getRepository('App:User')->findOneBy(['username'=>$username]);

        $cart->setClient($user);
            foreach ($box['items']  as $item)
            {
                $line = new Item();
                $product=$this->customLoader->LoadOne('App:Product', $item['slug']);
                $line->setProduct($product);
                $line->setPrice($item['price']);
                $line->setBread($item['bread']);
                property_exists('item', 'halal') ? $line->setHalal($item->halal) : $line->setHalal(false) ;

                if (property_exists('item', 'vegetables') && is_array($item->vegetables))
                {
                    foreach ($item->vegetables as $vege) {
                        $line->addVegetable($vege);
                        }
                 }

                $cart->addItem($line);

            }
        $cart->setClient($user);

        if ($this->customPersister->insert($cart)){
            $result=$cart;
            $status = 200;
           // $this->notifier->notify('new_order', ['commande'=>$cart]);
        } else {
            $result = ['message'=>'erreur serveur'];
            $status = 500;
        }

        $hateoas = HateoasBuilder::create()->build();
        $json = $hateoas->serialize($result, 'json');

//        $context = new ZMQContext();
//        try {
//            $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
//            $socket->connect("tcp://localhost:5555");
//            $socket->send(json_encode($json));
//        } catch (\ZMQSocketException $e) {
//        }


        $this->notifier->notify('new_order', ['order'=>$json]);
        $response = new Response($json, $status, array('application/json'));
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET');
        return ($response);
    }

    /**
     * @Delete("order/{id}", name="orders_delete")
     */
    public function delete(Cart $order, Request $request) {

        $removed = $order->getId();
        try {
            $this->em->remove($order);
            $this->em->flush();
            $status = 200;
            $result = $removed ;
        } catch (\Doctrine\DBAL\DBALException $e) {
            $status = 500;
            $result = ['message' => 'erreur de suppression'];
        }

        $hateoas = HateoasBuilder::create()->build();
        $json = $hateoas->serialize($result, 'json');

        $this->notifier->notify('remove_order', ['id'=>$removed]);
        $response = new Response($json, $status, array('application/json'));
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET');
        return ($response);
    }
    /**
     * @Patch("order/{id}/done", name="orders_done")
     */
    public function done(Cart $order, Request $request) {
        try {
            $order->setDone(true);
            $this->customPersister->update($order);
            $status = 200;
            $result = ['done' => $order->getId()] ;
            $this->notifier->notify('update_order', $result);
        } catch (\Doctrine\DBAL\DBALException $e) {
            $status = 500;
            $result = ['message' => 'erreur de suppression'];
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
