<?php

Namespace App\Controller\Api\User ;


use App\Model\CustomObjectLoaderInterface;
use App\Service\CustomObjectLoader;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;
use Hateoas\Hateoas;
use Hateoas\HateoasBuilder;
use Symfony\Component\HttpFoundation\Response;

class UserController extends FOSRestController {

    protected $userLoader;
    protected $objectLoader;
    protected $em;
    protected $hateoas;

    public function __construct(CustomObjectLoaderInterface $objectLoader )
    {
        $this->objectLoader = $objectLoader;
    }

    /**
     * @Get("s/profile", name="get_user")
     */
    public function getUser()
    {
        $hateoas = HateoasBuilder::create()->build();
        $user = $this->getUser();
        $json = $hateoas->serialize($user,'json');
        $response = new Response($json, 200, array('application/json'));
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        return $response;
    }

}