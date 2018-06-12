<?php

namespace App\Controller;

use App\Service\FeaturedProducts;
use mageekguy\atoum\asserters\variable;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

class defaultController extends Controller {


    /**
     * @Route("/", name="default")
     */
    public function index(Request $request){
        /*
       $featured_products = $featured->getFeatured();
       $lastProducts = $featured->getLast(3);
       $this->get('app.products')->featured =  $featured_products;
       $this->get('app.products')->last =  $lastProducts;
        */
        $notification = 'A message has been received by the server!<br />';

        // Handling form
        $form = $this->createFormBuilder()->getForm();
        $form->handleRequest($request);

        // If form valid
        if ($form->isSubmitted() && $form->isValid()) {

            // Calling PHP Redis from global namespace
  //          $redis = new \Redis();

            // Connecting on localhost and port 6379
    //        $redis->connect('127.0.0.1', '6379');

            // Creating Emitter
           /* $emitter = new Emitter($redis);

            // Emit a notification on channel 'notification'
            $emitter->emit('notification', $notification);
*/
            // Returning status via JsonResponse
            $response = new JsonResponse();
            /* ***           $response->setData(array(
                           'notification' => 'envoyé'
                       ));
                       $client = new Client(new Version2X('http://localhost:3000'));
                       $client->initialize();
                       $client->emit('notification', ['notification'=>$notification]);
                       $client->close();
           ** */
            return $response;

        }
       return $this->render('index.html.twig', ['form' => $form->createView()]);

    }

}
