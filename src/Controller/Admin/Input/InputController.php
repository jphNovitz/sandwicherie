<?php

namespace App\Controller\Admin\Input;

use App\Entity\Input ;
use App\Form\InputType;
use App\Form\InputTypeType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/input/new", name="input_add")
     */
    public function add(Request $request)
    {
        $input = new Input();
        $form = $this->createForm(InputType::class, $input);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()):
            $this->customPersister->insert($input);
            die('fait');
        endif;

        return $this->render('Form/input.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("/inputs", name="inputs_list")
     */
    public function list()
    {
        $list = $this->customLoader->LoadAll('App:Input');
        return $this->render('Input/inputs-list.html.twig', [
            'list'=>$list
        ]);
    }

    /**
     * @Route("/input/{id}", name="input_show")
     */
    public function show(Request $request, Input $input){
        return $this->render('Input/input-card.html.twig', [
            'input'=>$input
        ]);
    }
}
