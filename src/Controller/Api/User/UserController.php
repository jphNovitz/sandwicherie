<?php
Namespace App\Controller\Api\User ;

use App\Model\CustomObjectLoaderInterface;
use App\Model\CustomPersisterInterface;
use App\Service\CustomObjectLoader;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Hateoas\Hateoas;
use Hateoas\HateoasBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserController extends AbstractController {

    protected $objectLoader;
    protected $persister;
    protected $em;
    protected $hateoas;
    protected $tokenStorage ;

    public function __construct(CustomObjectLoaderInterface $objectLoader,
                                TokenStorageInterface $tokenStorage,
                                CustomPersisterInterface $persister )
    {
        $this->objectLoader = $objectLoader;
        $this->tokenStorage = $tokenStorage;
        $this->persister = $persister;
    }

    /**
     * @Get("s/profile", name="get_user")
     */
    public function getUser()
    {
        $hateoas = HateoasBuilder::create()->build();
        $user = $this->tokenStorage->getToken()->getUser();
        $json = $hateoas->serialize($user,'json');
        $response = new Response($json, 200, array('application/json'));
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        return $response;
    }

    /**
     * @Put("s/profile", name="update_user")
     */
    public function updateUser(Request $request)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $data = $request->getContent();
        $user_received = $this->get('jms_serializer')->deserialize($data, 'App\Entity\User', 'json');
        $user = $user_received;

        $hateoas = HateoasBuilder::create()->build();

        try {
            $this->persister->update($user);
            $json = $hateoas->serialize($user,'json');
            $status = 200 ;
        } catch (\Exception $e){
            $json = $hateoas->serialize(['message'=>$e],'json');
            $status = 500 ;
        }

        $response = new Response($json, $status, array('application/json'));
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        return $response;
    }

}