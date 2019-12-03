<?php

namespace App\Controller\Front;

use App\Service\FeaturedProducts;
use App\Service\Instagram;
use App\Service\SiteConfiguration;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class frontController extends AbstractController {

    protected $featuredProducts;
    protected $siteConfiguration;

    public function __construct(FeaturedProducts $featuredProducts, SiteConfiguration $siteConfiguration)
    {
        $this->featuredProducts = $featuredProducts;
        $this->siteConfiguration = $siteConfiguration;
    }

    /**
     * @Route("/", name="home", schemes={"https"})
     */
    public function index(/*, Instagram $instagram*/){

        $cache = new FilesystemAdapter();

        $last = $cache->get('last_products', function (CacheItem $item){
            $item->expiresAfter(\DateInterval::createFromDateString('1 day'));
           return  $this->featuredProducts->getLast(5);
        });
        $featured = $cache->get('featured_products', function (CacheItem $item){
            $item->expiresAfter(\DateInterval::createFromDateString('3 day'));
           return  $this->featuredProducts->getFeatured();
        });
        $pitch = $cache->get('site_pitch', function (CacheItem $item){
            $item->expiresAfter(\DateInterval::createFromDateString('1 month'));
           return  $this->siteConfiguration->getPitch();
        });

       return $this->render('Front/index.html.twig', [
           'last_products' => $last,
           'featured_products' => $featured,
           'pitch' => $pitch
       ]);

    }

    public function infos(ContainerInterface $container){
        $path = $container->get('kernel')->getRootDir();
        $infos = file_get_contents ($path.'/File/site.json');
        return $this->render('_elements/footer_info.html.twig',
            ['raw_infos'=>$infos]);
    }

    public function pitch(SiteConfiguration $siteConfiguration){
        return new Response($siteConfiguration->getPitch());
    }


}
