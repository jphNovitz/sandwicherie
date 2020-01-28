<?php

namespace App\EventListener;

use JMS\SerializerBundle\Templating\SerializerHelper;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Twig\Environment;

class MaintenanceListener
{
    private $container;
    private $params;
    private $twig_Environment;

    public function __construct(ContainerInterface $container, ParameterBagInterface $params, \Twig_Environment $twig_Environment)
    {
        $this->container = $container;
        $this->params = $params;
        $this->twig_Environment = $twig_Environment;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {

        // This will get the value of our maintenance parameter
        $maintenance = $this->params->get('maintenance') ? $this->params->get('maintenance') : false;

        // This will detect if we are in dev environment (app_dev.php)
        $debug = in_array($this->container->get('kernel')->getEnvironment(), ['dev']);

        // If maintenance is active and in prod environment
        if ($maintenance && !$debug) {
            // We load our maintenance template
//            $engine =  $this->container->get('templating');
            $filesystemLoader = new FilesystemLoader(__DIR__.'/../../templates/%name%');

            $engine = new PhpEngine(new TemplateNameParser(), $filesystemLoader);

//            $template = $this->twig_Environment->render('Front/System/maintenance.html.twig');
//            $template = $engine->render('/Front/System/maintenance.html.twig');
            $template = $engine->render('/Front/System/maintenance.html.twig');

            // We send our response with a 503 response code (service unavailable)
            $event->setResponse(new Response($template, 503));
            $event->stopPropagation();
        }
    }
}
