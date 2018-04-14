<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class defaultController extends Controller {


    /**
     * @Route("/", name="default")
     */
    public function index(){
        $this->get('app.front_image')->testo="toto";
        return $this->render('index.html.twig');

    }

}
