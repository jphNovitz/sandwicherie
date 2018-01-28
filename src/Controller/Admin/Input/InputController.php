<?php

namespace App\Controller\Admin\Input;

use App\Entity\Input ;
use App\Form\InputType;
use App\Form\InputTypeType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class InputController
 * @package App\Controller\Admin\Input
 * @Route("/admin/inputs/")
 * @Method({"GET"})
 */
class InputController extends Controller
{

    protected $customPersister;
    protected $customLoader;

    public function __construct(CustomPersister $customPersister, CustomObjectLoader $customObjectLoader)
    {
        $this->customPersister = $customPersister;
        $this->customLoader = $customObjectLoader;
    }

    /**
     * @Route("", name="inputs_list")
     */
    public function list()
    {
        $list = $this->customLoader->LoadAll('App:Input');

        return $this->render($this->getParameter('adm_input').'inputs-list.html.twig', [
            'list'=>$list
        ]);
    }

    /**
     * @Route("new", name="inputs_add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request)
    {
        $input = new Input();
        $form = $this->createForm(InputType::class, $input);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->insert($input)):
                $this->addFlash("success",
                    "marchandise encodée  !");
            else:
                $this->addFlash("error",
                    "Problème dans l'encodage ");
            endif;
            return $this->redirectToRoute('inputs_add');
        endif;

        return $this->render($this->getParameter('adm_input').'form/input-add.html.twig', [
            'form'=>$form->createView()
        ]);

    }



    /**
     * @Route("{id}", name="inputs_show")
     */
    public function show(Request $request, Input $input){
        return $this->render('Admin/Input/input-card.html.twig', [
            'input'=>$input
        ]);
    }

    /**
     * @Route("{slug}/update", name="inputs_update")
     * @Method({"GET", "POST"})
     */
    public function update(Request $request, Input $input){

        if (!$input) {
            $this->addFlash("error", "Pas d'entrée trouvée ");
            return $this->redirectToRoute('ingredients_list');
        }

        $form = $this->createForm(InputType::class, $input);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->insert($input)):
                $this->addFlash("success",
                    "marchandise encodée  !");
            else:
                $this->addFlash("error",
                    "Problème dans l'encodage ");
            endif;
            return $this->redirectToRoute('inputs_add');
        endif;

        return $this->render($this->getParameter('adm_input').'form/input-update.html.twig', [
            'form'=>$form->createView()
        ]);

    }
}
