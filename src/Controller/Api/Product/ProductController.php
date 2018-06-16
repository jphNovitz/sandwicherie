<?php

namespace App\Controller\Api\Product;

use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends FOSRestController{

    protected  $customLoader;
    protected  $customPersister;

    public function __construct(CustomObjectLoader $customObjectLoader, CustomPersister $persister)
    {
        $this->customLoader = $customObjectLoader;
        $this->customPersister = $persister;
    }



    /**
     * @Get("products", name="get_products")
     */
    public function getProducts()
    {
        return  $this->customLoader->CreateJsonResponse('App:Product');
    }


    /**
     * @Patch("products/{slug}/like/{user}", name="like_products")
     */
    public function likeProducts($slug, $user)
    {
        $product = $this->customLoader->LoadOne('App:Product', $slug);
        $user = $this->get('doctrine.orm.default_entity_manager')->getRepository('App:User')->loadUserByUsername($user);
        if ($product->getLikedBy()->contains($user)){
            $product->removeLikedBy($user);
        } else {
            $product->addLikedBy($user);
        }


        $this->customPersister->update($product);
        $response = new Response('ok', 200, array('application/json'));
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        return $response;
    }

}