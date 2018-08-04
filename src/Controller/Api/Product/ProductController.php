<?php

namespace App\Controller\Api\Product;

use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\FOSRestController;
use Hateoas\HateoasBuilder;
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
        $this->customLoader->CreateJsonResponse('App:Product');
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


    /**
     * @Patch("s/products/{slug}/like", name="like_product")
     */
    public function likeProduct($slug)
    {
        $product = $this->customLoader->LoadOne('App:Product', $slug);
        $user = $this->getUser();
        if (!$user) return;

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



    /**
     * @Get("s/profile/favorites", name="get_favorites")
     */
    public function getFavorites()
    {
        $user = $this->getUser();
        $repo = $this->get('doctrine.orm.default_entity_manager')->getRepository('App:Product');
        $favs = $repo->findFavorites($user);
        $hateoas = HateoasBuilder::create()->build();
        $json = $hateoas->serialize($favs,'json');
        $response = new Response($json, 200, array('application/json'));
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        return $response;


    }

}