<?php

namespace App\Controller;

use App\Entity\Provider ;
use App\Form\ProviderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class ProviderController extends Controller
{
    /**
     * @Route("/provider", name="provider")
     */
    public function index()
    {
        return new Response('Welcome to Provider');
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
            return new Response('submitted');
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
