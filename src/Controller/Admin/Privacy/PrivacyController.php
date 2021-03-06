<?php

namespace App\Controller\Admin\Privacy;

use App\Entity\Privacy ;
use App\Form\PrivacyType;
use App\Model\CustomObjectLoaderInterface;
use App\Model\CustomPersisterInterface;
use App\Service\DeleteObject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DeleteType;

/**
 * Class PrivacyController
 * @package App\Controller\Admin\Privacy
 * @Route("/admin/configuration/privacy/")
 * @Method({"GET"})
 */
class PrivacyController extends AbstractController
{

    private $persister;
    private $loader;
    private $deleter;

    public function __construct(CustomPersisterInterface $persister,
                                CustomObjectLoaderInterface $loader,
                                DeleteObject $deleter){
        $this->persister = $persister;
        $this->loader = $loader ;
        $this->deleter = $deleter ;
    }

    /**
     * @Route("", name="privacies_list")
     */
    public function index(Request $request)
    {
        $list =  $this->loader->LoadAll('App:Privacy');

        if(!$list) {
            $this->addFlash('info', 'aucun élément trouvé.');
            return $this->redirectToRoute('privacies_add');
        }
        return $this->render('Admin/Privacy/privacies-list.html.twig', ['list'=>$list]);
    }

    /**
     * @Route("create", name="privacies_add")
     * @Method({"GET", "POST"})
     */
    public function create(Request $request){
        $privacy = new Privacy();
        $form = $this->createForm(PrivacyType::class, $privacy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            if ($this->persister->insert($privacy)){
                $this->addFlash('success', 'Privacy enregistrée');
            }
        }
        return $this->render('Admin/Privacy/form/privacy_add.html.twig',
                ['form'=>$form->createView()]);
    }

    /**
     * @Route("{slug}", name="privacies_show")
     */
    public function show(Privacy $privacy){
        return $this->render('Admin/Privacy/privacy-card.html.twig', ['privacy'=>$privacy]);
    }

    /**
     * @Route("{slug}/update", name="privacies_update")
     * @Method({"GET", "POST"})
     */
    public function update(Request $request, Privacy $privacy){
        $form = $this->createForm('App\Form\PrivacyType', $privacy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()):
            if ($this->persister->update($privacy)){
                $this->addFlash('succes', 'Privacy Modifié ');
                return $this->redirectToRoute('privacies_list');
        } else {
                $this->addFlash('error', 'Privacy NON Modifié ');
                return $this->render('Admin/Privacy/form/privacy_update.html.twig',
                    ['form'=>$form->createView()]);
            }

        endif;

        return $this->render('Admin/Privacy/form/privacy_update.html.twig',
            ['form'=>$form->createView()]);
    }

    /**
     * @Route("{slug}/delete", name="privacies_delete")
     * @Method({"GET", "DELETE"})
     */
    public function delete(Request $request, Privacy $privacy = NULL )
    {
        if (!$privacy){
            $this->addFlash("error", "inconnu");
            return $this->redirectToRoute('privacies_list');
        }
        $form = $this->createForm(DeleteType::class,null,['method'=>'DELETE']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($form->get('oui')->isClicked()) {

                if ($this->deleter->delete($privacy)){
                    $this->addFlash('success', 'Privacy supprimé');
                } else {

                    $this->addFlash('error', 'Privacy non supprimé');
                }

            }
            return $this->redirectToRoute('privacies_list');

        endif;

        return $this->render('Admin/Privacy/form/privacy-delete.html.twig',
            [
                'object' => $privacy,
                'form' => $form->createView()
            ]);
    }
}