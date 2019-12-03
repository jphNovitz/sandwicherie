<?php

namespace App\Controller\Api\Product;

use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Patch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TypeController extends AbstractController{

    protected  $customLoader;
    protected  $customPersister;

    public function __construct(CustomObjectLoader $customObjectLoader, CustomPersister $persister)
    {
        $this->customLoader = $customObjectLoader;
        $this->customPersister = $persister;
    }



    /**
     * @Get("types", name="get_types")
     */
    public function getTypes()
    {
        return  $this->customLoader->CreateJsonResponse('App:Type');
    }
}