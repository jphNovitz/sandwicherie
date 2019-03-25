<?php

namespace App\Controller\Api\Privacy;

use App\Model\CustomObjectLoaderInterface;
use App\Model\PrepareBuilderInterface;
use App\Service\PrepareBuilder;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\FOSRestBundle;
use Hateoas\Hateoas;
use Hateoas\HateoasBuilder;
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

    /**
     * @Rest\Route("public/infos", name="api_infos_show")
     */
    public function infos(PrepareBuilder $builder){

        $path = $this->container->get('kernel')->getRootDir();
        $infos = file_get_contents ($path.'/File/site.json');
//        $hateoas = $hateoas = HateoasBuilder::create()->build();
//        $serialized = $hateoas->serialize($infos, 'json');
        $response = $builder->prepare($infos, 200);
//        dump($response->headers);
        return $response;
    }
}