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
    public function index(FeaturedProducts $featured){
      /*  $toto='toto';*/

       $featured_products = $featured->getFeatured();

       //dump($featured_products);
       // $this->get('app.front_image')->testo =  (array)(object)$test;
        $this->get('app.featured_products')->list =  $featured_products;
        // dump($this->get('app.front_image')->testo);
        return $this->render('index.html.twig');

    }

}
