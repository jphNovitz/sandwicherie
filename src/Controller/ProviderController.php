<?php

namespace App\Controller;

use App\Entity\Provider ;
use App\Form\ProviderType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class ProviderController extends Controller
{
    protected $customPersister;
    protected $customLoader;

    public function __construct(CustomPersister $customPersister, CustomObjectLoader $customObjectLoader)
    {
        $this->customPersister = $customPersister;
        $this->customLoader = $customObjectLoader;
    }

    /**
     * @Route("/provider", name="provider")
     */
    public function index()
    {
       //$list=$this->getDoctrine()->getManager()->getRepository('App:Provider')->findAll();
       $list = $this->customLoader->LoadAll('App:Provider');
       //var_dump($list);die();
        return $this->render('Provider/providers-list.html.twig', [
            'list'=>$list
        ]);
    }

    /**
     * @Route("/provider/new", name="provider_add")
     */
    public function add(Request $request)
    {
        $provider = new Provider();
        $form = $this->createForm(ProviderType::class, $provider);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
           $this->customPersister->insert($provider);
            die('fait');
        endif;
        return $this->render('Form/provider.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("/provider/{id}/update", name="provider_update")
     */
    public function update(Request $request, Provider $provider= NULL )
    {

        if (!$provider) {
            return new Response('update a provider');
        }
        return new Response('update a provider');
    }
}
