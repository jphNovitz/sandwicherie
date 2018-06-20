<?php

namespace App\Controller\Api\Allergy;

use App\Entity\Allergy ;
use App\Form\AllergyType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DeleteType;
use App\Service\DeleteObject;
use FOS\RestBundle\Controller\Annotations as Rest;
use Hateoas\HateoasBuilder;
use FOS\RestBundle\Controller\Annotations\Get;






class AllergyController extends FOSRestController
{
    protected $serializer;
    protected $customPersister;
    protected $customLoader;
    protected  $deleter;

    public function __construct(CustomPersister $customPersister,
                                CustomObjectLoader $customObjectLoader,
                                DeleteObject $deleter, ContainerInterface $container)
    {
        $this->customLoader = $customObjectLoader;
        $this->serializer = $container->get('jms_serializer');
    }

    /**
     * @Get("allergies", name="get_allergies")
     */
    public function getAllergies()
    {
        //$list = $this->customLoader->LoadAll('App:Allergy');
        $list = $this->customLoader->CreateJsonResponse('App:Allergy');

        /*
        $hateoas = HateoasBuilder::create()->build();
        $json = $hateoas->serialize($list,'json');
        $response = new Response($json, 200, array('application/json'));
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');

        return ($response);
        */
        return ($list);
    }
}
