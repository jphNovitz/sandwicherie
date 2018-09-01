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
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class defaultController extends Controller {


    /**
     * @Route("/", name="default")
     */
    public function index(Request $request){
       return $this->render('index.html.twig');

    }


}
