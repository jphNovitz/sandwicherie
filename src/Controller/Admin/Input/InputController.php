<?php

namespace App\Controller\Admin\Input;

use App\Entity\Input;
use App\Model\CustomObjectLoaderInterface;
use App\Model\CustomPersisterInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class InputController
 * @package App\Controller\Admin\input
 * @Route("admin/input/")
 * @Method({"GET"})
 */
class InputController extends Controller{

    protected $loader;
    protected $persister;

    public function __construct(CustomObjectLoaderInterface $loader,
                                CustomPersisterInterface $persister)
    {
        $this->loader = $loader ;
        $this->persister = $persister ;
    }

    /**
     * @Route("", name="inputs_list")
     */
    public function index(){
        $list = $this->loader->LoadAll("App:Input");

        if (!$list) {
            $this->addFlash('warning','Aucune entrée trouvée');
            return $this->redirectToRoute('inputs_create');
        }
        return $this->render('Admin/Input/inputs-list.html.twig', ['list'=>$list]);

    }

    /**
     * @param Request $request
     * @Route("new", name="inputs_create")
     * @Method({"GET", "POST"})
     * @return
     */
    public function newInput(Request $request){
        $input = new Input();
        $form = $this->createForm('App\Form\InputType', $input );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            $this->persister->insert($input);
            return $this->redirectToRoute('inputs_list');
         endif;

         return $this->render('Admin/Input/form/input-add.html.twig', [
             'form'=>$form->createView()
         ]);
    }
}