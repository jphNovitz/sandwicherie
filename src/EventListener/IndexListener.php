<?php
namespace App\EventListener;

use App\Entity\Site;
use App\Service\FeaturedProducts;
use App\Service\SiteConfiguration;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class IndexListener implements EventSubscriberInterface {

   protected $featured;
   protected $siteConfiguration;
   protected  $container;
   protected $serializer;

    public function __construct(ContainerInterface $container,
                                FeaturedProducts $featuredProducts, SiteConfiguration $siteConfiguration)
    {
        $this->featured = $featuredProducts;
        $this->siteConfiguration = $siteConfiguration;
        $this->container = $container;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = explode('\\',get_class($event->getController()[0]));

        if (strtolower($controller[2]) == 'defaultcontroller'){
            $featured_products = $this->featured->getFeatured();
            $lastProducts = $this->featured->getLast(3);
            $this->container->get('app.products')->featured =  $featured_products;
            $this->container->get('app.products')->last =  $lastProducts;

            $this->container->get('app.site')->site = $this->siteConfiguration->getGeneral();
        }

    }
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController',
        );
    }

}