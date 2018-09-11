<?php

namespace App\Controller\Admin\Privacy;

use App\Entity\Privacy ;
use App\Form\PrivacyType;
use App\Model\CustomPersisterInterface;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use App\Service\DeleteObject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
class PrivacyController extends Controller
{

    private $persister;

    public function __construct(CustomPersisterInterface $persister){
        $this->persister = $persister;
    }

    /**
     * @Route("", name="privacy_creation")
     * @Method({"GET", "POST"})
     */
    public function create(Request $request, Privacy $privacy = NULL){
        if (!$privacy){
            $privacy = new Privacy();
        }
        $flag = $privacy->getId();

        $form = $this->createForm(PrivacyType::class, $privacy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            if(!$flag):
                if ($this->persister->insert($privacy)){
                    $this->addFlash('success', 'Privacy enregistrée');
                }
            else
                if ($this->persister->update($privacy)){
                    $this->addFlash('success', 'Privacy modifié');
                }
            endif;

        }

        if (!$flag){
            return $this->render('Admin/Privacy/form/privacy_add.html.twig',
                ['form'=>$form->createView()]);
        }
    }

}