<?php

namespace App\Controller;

use App\Service\FeaturedProducts;
use mageekguy\atoum\asserters\variable;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class defaultController extends Controller {


    /**
     * @Route("/", name="default")
     */
    public function index(){
        /*
       $featured_products = $featured->getFeatured();
       $lastProducts = $featured->getLast(3);
       $this->get('app.products')->featured =  $featured_products;
       $this->get('app.products')->last =  $lastProducts;
        */
       return $this->render('index.html.twig');

    }

}
