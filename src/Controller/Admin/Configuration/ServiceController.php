<?php

namespace App\Controller\Admin\Configuration;

use App\Entity\Service ;
use App\Form\ServiceType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DeleteType;
use App\Service\DeleteObject;

/**
 * Class ServiceController
 * @package App\Controller\Admin\Configuration
 * @Route("/admin/configuration/services/")
 * @Method({"GET"})
 */
class ServiceController extends Controller
{
    protected $customPersister;
    protected $customLoader;
    protected  $deleter;

    public function __construct(CustomPersister $customPersister,
                                CustomObjectLoader $customObjectLoader,
                                DeleteObject $deleter)
    {
        $this->customPersister = $customPersister;
        $this->customLoader = $customObjectLoader;
        $this->deleter = $deleter;
    }

    /**
     * @Route("", name="services_list")
     */
    public function index()
    {
        $list = $this->customLoader->LoadAll('App:Service');
        if (!$list) {
            $this->addFlash("notice", "Aucun service trouvé, ajoutez-en un ");
            return $this->redirectToRoute('services_add');
        }
        return $this->render( $this->getParameter('adm_service').'services-list.html.twig',
            ['list'=>$list]);
    }

    /**
     * @Route("new", name="services_add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request)
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->insert($service)){
                $this->addFlash("success", "Service ajoutée.");
                return $this->redirectToRoute('services_add');
            } else {
                $this->addFlash("error", "Il y a eu un problème, service non ajoutée.");
            }
        endif;
        return $this->render($this->getParameter('adm_service').'/form/service-add.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("{slug}", name="services_show")
     */
    public function show(Request $request, Service $service = null)
    {
        if (!$service){
            $this->addFlash("error", "Service inconnu");
            return $this->redirectToRoute('services_list');
        }
        return $this->render($this->getParameter('adm_service').'/service-card.html.twig',
                    ['service'=>$service]);
    }



    /**
     * @Route("{slug}/update", name="services_update")
     *  @Method({"GET", "POST"})
     */
    public function update(Request $request, Service $service = NULL )
    {
        if (!$service) {
            $this->addFlash("error", "Service inconnu");
            return $this->redirectToRoute('services_list');
        }
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->update($service)){
                $this->addFlash("success", "Service modifié");
                return $this->redirectToRoute('services_update', ['slug'=>$service->getSlug()]);
            } else {
                $this->addFlash("error", "Il y a eu un problème, service non modifiée.");
            }
        endif;
        return $this->render('Admin/Service/form/service-update.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("{slug}/delete", name="services_delete")
     * @Method({"GET", "POST"})
     */
    public function delete(Request $request, Service $service = NULL )
    {
        if (!$service){
            $this->addFlash("error", "service inconnu");
            return $this->redirectToRoute('services_list');
        }
        $form = $this->createForm(DeleteType::class,null);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($form->get('oui')->isClicked()) {
                return $this->deleter->delete($service);
            }
            if ($form->get('non')->isClicked())
                return $this->redirectToRoute('services_list');

        endif;

        return $this->render('Admin/Service/form/service-delete.html.twig',
            [
                'object' => $service,
                'form' => $form->createView()
            ]);
    }
}
