<?php

namespace App\Controller\Admin\Allergy;

use App\Entity\Allergy ;
use App\Form\AllergyType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;use App\Form\DeleteType;
use App\Service\DeleteObject;
/**
 * Class AllergyController
 * @package App\Controller\Admin\Allergy
 * @Route("/admin/allergies/")
 * @Method({"GET"})
 */
class AllergyController extends Controller
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
     * @Route("", name="allergies_list")
     */
    public function index()
    {
        $list = $this->customLoader->LoadAll('App:Allergy');
        if (!$list) {
            $this->addFlash("notice", "Aucun allergie trouvé, ajoutez-en un ");
            return $this->redirectToRoute('allergies_add');
        }
        return $this->render( $this->getParameter('adm_allergy').'allergies-list.html.twig',
            ['list'=>$list]);
    }

    /**
     * @Route("new", name="allergies_add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request)
    {
        $allergy = new Allergy();
        $form = $this->createForm(AllergyType::class, $allergy);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->insert($allergy)){
                $this->addFlash("success", "Allergie ajoutée.");
                return $this->redirectToRoute('allergies_add');
            } else {
                $this->addFlash("error", "Il y a eu un problème, allergie non ajoutée.");
            }
        endif;
        return $this->render($this->getParameter('adm_allergy').'/form/allergy-add.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("{slug}", name="allergies_show")
     */
    public function show(Request $request, Allergy $allergy=null)
    {
        if (!$allergy){
            $this->addFlash("error", "Allergie inconnue");
            return $this->redirectToRoute('allergies_list');
        }
        return $this->render($this->getParameter('adm_allergy').'/allergy-card.html.twig', ['allergy'=>$allergy]);
    }



    /**
     * @Route("{slug}/update", name="allergies_update")
     *  @Method({"GET", "POST"})
     */
    public function update(Request $request, Allergy $allergy= NULL )
    {
        if (!$allergy) {
            $this->addFlash("error", "Allergie inconnus");
            return $this->redirectToRoute('allergies_list');
        }
        $form = $this->createForm(AllergyType::class, $allergy);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->update($allergy)){
                $this->addFlash("success", "Allergie modifiée.");
                return $this->redirectToRoute('allergies_update', ['slug'=>$allergy->getSlug()]);
            } else {
                $this->addFlash("error", "Il y a eu un problème, allergie non modifiée.");
            }
        endif;
        return $this->render('Admin/Allergy/form/allergy-update.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("{slug}/delete", name="allergies_delete")
     * @Method({"GET", "POST"})
     */
    public function delete(Request $request, Allergy $allergy = NULL )
    {
        if (!$allergy){
            $this->addFlash("error", "allergie inconnue");
            return $this->redirectToRoute('allergies_list');
        }
        $form = $this->createForm(DeleteType::class,null);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($form->get('oui')->isClicked()) {
                return $this->deleter->delete($allergy);
            }
            if ($form->get('non')->isClicked())
                return $this->redirectToRoute('allergies_list');

        endif;

        return $this->render('Admin/Allergy/form/allergy-delete.html.twig',
            [
                'object' => $allergy,
                'form' => $form->createView()
            ]);
    }
}
