<?php

namespace App\Controller\Admin\Provider;

use App\Entity\Provider ;
use App\Form\ProviderType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProviderController
 * @package App\Controller\Admin\Provider
 * @Route("/admin/providers/")
 * @Method({"GET"})
 */
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
     * @Route("", name="providers_list")
     */
    public function index()
    {
        $list = $this->customLoader->LoadAll('App:Provider');
        if (!$list) {
            $this->addFlash("notice", "Aucun fournisseur trouvé, ajoutez-en un ");
            return $this->redirectToRoute('providers_add');
        }
        return $this->render('Admin/Provider/providers-list.html.twig', ['list'=>$list]);
    }

    /**
     * @Route("new", name="providers_add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request)
    {
        $provider = new Provider();
        $form = $this->createForm(ProviderType::class, $provider);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->insert($provider)){
                $this->addFlash("success", "Le fournisseur a été ajouté.");
                return $this->redirectToRoute('providers_add');
            } else {
                $this->addFlash("error", "Il y a eu un problème, fournisseur non ajouté");
            }
        endif;
        return $this->render('Admin/Provider/provider-add.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("{id}", name="providers_show")
     */
    public function show(Request $request, Provider $provider=null)
    {
        if (!$provider){
            $this->addFlash("error", "fournisseur inconnu");
            return $this->redirectToRoute('providers_list');
        }
        return $this->render('Admin/Provider/provider-card.html.twig', ['provider'=>$provider]);
    }



    /**
     * @Route("{slug}/update", name="providers_update")
     */
    public function update(Request $request, Provider $provider= NULL )
    {
        if (!$provider) {
            $this->addFlash("error", "fournisseur inconnu");
            return $this->redirectToRoute('providers_list');
        }
        $form = $this->createForm(ProviderType::class, $provider);
        $form->handleRequest($request);
        return $this->render('Admin/Provider/provider-update.html.twig', [
            'form'=>$form->createView()
        ]);
    }

}
