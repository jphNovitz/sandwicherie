<?php
namespace App\Controller\Allergy;

use App\Entity\Allergy;
use App\Form\AllergyType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("admin/allergy/{id}", name="allergy_show")
     */
    public function show(Request $request, Allergy $allergy = null){
        if (!$allergy) {
            return $this->redirectToRoute('allergies_list');
        }
        return $this->render('Allergy/allergy-card.html.twig', [
            'allergy'=>$allergy
        ]);
    }
    /**
     * @Route("admin/allergy/{id}/update", name="allergy_update")
     */
    public function update(Request $request, Allergy $allergy = null){
        if (!$allergy) {
            return $this->redirectToRoute('allergies_list');
        }

        $form = $this->createForm(AllergyType::class, $allergy);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()):
            $this->customPersister->update($allergy);
            return $this->render('Allergy/allergy-card.html.twig', [
                'allergy'=>$allergy
            ]);
        endif;
        return $this->render('Form/allergy.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}