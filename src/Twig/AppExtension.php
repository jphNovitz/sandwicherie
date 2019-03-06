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
            new TwigFilter('entity', [$this, 'entityFilter']),
            new TwigFilter('json_decode', [$this, 'jsonDecode']),
        );
    }

    public function entityFilter($classname)
    {
         $chain =  explode("\\",get_class($classname));
         if (substr($chain[2],-1) === 'y'):
             $word = substr($chain[2],0, -1)."ie";
         else:
             $word = $chain[2];
         endif;
         return strtolower($word.'s')   ;
    }

    public function jsonDecode($encoded)
    {
        return  json_decode($encoded,true );
    }

}