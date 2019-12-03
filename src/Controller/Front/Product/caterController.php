<?php

namespace App\Controller\Front\Product ;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class caterController extends AbstractController
{
    /**
     * @Route("/traiteur", name="front_cater", schemes={"https"})
     */
    public function show()
    {
        return $this->render('Front/Product/cater-intro.html.twig');
    }
}