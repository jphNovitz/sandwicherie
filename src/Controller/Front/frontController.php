<?php

namespace App\Controller\Front;

use App\Service\FeaturedProducts;
use App\Service\Instagram;
use App\Service\SiteConfiguration;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class frontController extends Controller {


    /**
     * @Route("/", name="home")
     */
    public function index(Request $request,
                          FeaturedProducts $featuredProducts,
                          SiteConfiguration $siteConfiguration
        /*, Instagram $instagram*/){

        $last = $featuredProducts->getLast(3);

        $featured = $featuredProducts->getFeatured();
        $pitch = $siteConfiguration->getPitch();
       return $this->render('Front/index.html.twig', [
           'last_products' => $last,
           'featured_products' => $featured,
           'pitch' => $pitch
       ]);

    }

    public function infos(){
        $path = $this->container->get('kernel')->getRootDir();
        $infos = file_get_contents ($path.'/File/site.json');
        return $this->render('_elements/footer_info.html.twig',
            ['raw_infos'=>$infos]);
    }

    public function pitch(SiteConfiguration $siteConfiguration){
        return new Response($siteConfiguration->getPitch());
    }


}
