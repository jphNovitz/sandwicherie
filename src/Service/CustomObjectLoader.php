<?php

namespace App\Service;

use App\Model\CustomObjectLoaderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Hateoas\HateoasBuilder;
use Symfony\Component\HttpFoundation\Response;


class CustomObjectLoader implements CustomObjectLoaderInterface {

    protected $entityManager;
    protected $hateoas ;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function LoadOne(String $objectname, String $slug)
    {
        return $this->entityManager
            ->getRepository($objectname)
            ->findOneBy(['slug' => $slug]);
    }

    public function LoadAll(String $objectname)
    {
        return $this->entityManager
            ->getRepository($objectname)
            ->findAll();
    }
    public function CreateJsonResponse(String $objectname)
    {
        $hateoas = HateoasBuilder::create()->build();
        $raw = $this->entityManager
            ->getRepository($objectname)
            ->findAll();

        if (!$raw) {
            $json = $hateoas->serialize('Sorry no '.$objectname.' found','json');
            $response = new Response($json, 404, array('application/json'));
        } else {
            $json = $hateoas->serialize($raw,'json');
            $response = new Response($json, 200, array('application/json'));
        }

        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        return $response;
    }

}