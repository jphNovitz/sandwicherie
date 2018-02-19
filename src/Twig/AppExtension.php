<?php

namespace App\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Dump\Container;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('entity', array($this, 'entityFilter')),
        );
    }

    public function entityFilter($classname)
    {
         $chain =  explode("\\",get_class($classname));
         return strtolower($chain[2]).'s'   ;
    }
}