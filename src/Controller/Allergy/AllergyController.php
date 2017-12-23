<?php

namespace App\Controller\Allergy;

use App\Entity\Allergy;
use App\Form\AllergyType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AllergyController extends Controller{

    private $objectLoader;
    private $customPersister;

    public function __construct(
        CustomObjectLoader $customObjectLoader,
        CustomPersister $customPersister)
    {
        $this->objectLoader = $customObjectLoader;
        $this->customPersister = $customPersister;
    }

    /**
     * @Route("admin/allergies", name="allergies_list")
     */
    public function list(){

        $allergies = $this->objectLoader->LoadAll('App:Allergy');

        return $this->render('Allergy/allergies-list.html.twig', [
            'list'=>$allergies
        ]);

    }

    /**
     * @Route("admin/allergy/new", name="allergy_add")
     */
    public function newAllergy(Request $request){
        $allergy = new Allergy();
        $form = $this->createForm(AllergyType::class, $allergy);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()):
            $this->customPersister->insert($allergy);
            return $this->redirectToRoute('allergies_list');
        endif;

        return $this->render('Form/allergy.html.twig', [
            'form'=>$form->createView()
        ]);

    }
}