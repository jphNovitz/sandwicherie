<?php

namespace App\Controller\Api\Product;

use App\Service\CustomObjectLoader;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;


class ProductController extends FOSRestController{

    protected  $customLoader;
    public function __construct(CustomObjectLoader $customObjectLoader)
    {
        $this->customLoader = $customObjectLoader;
    }



    /**
     * @Get("products", name="get_products")
     */
    public function getProducts()
    {
        return  $this->customLoader->CreateJsonResponse('App:Product');
    }

}