<?php

namespace App\Controller\Api\Privacy;

use App\Model\CustomObjectLoaderInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\FOSRestBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class PrivacyController
 * @package App\Controller\Api\Privacy
 * @Rest\Route("privacy/")
 * @Method({"GET"})
 */
class PrivacyController extends FOSRestBundle{

    protected $loader ;

    public function __construct(CustomObjectLoaderInterface $loader)
    {
        $this->loader = $loader ;
    }

    /**
     * @Rest\Route("", name="api_privacies_list")
     */
    public function index(){
        $response = $this->loader->CreateJsonResponse('App:Privacy');
        return $response;
    }

    /**
     * @Rest\Route("{slug}", name="api_privacies_show")
     */
    public function show($slug){
        $response = $this->loader->CreateJsonResponse('App:Privacy', ['slug'=>$slug]);
        return $response;
    }
}