<?php

namespace App\Controller\Admin\Input;

use App\Entity\Input;
use App\Entity\Tag;
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
            $input->setTitle($input->getProvider()->getName().'_'.date("d-m-Y_H:i:s") );
        $all_tags = $this->get('doctrine.orm.default_entity_manager')
            ->getRepository('App:Tag')
            ->findAll();
        foreach ($input->getTags() as $tag){
            foreach ($all_tags as $all){

                if ($all->getName() === $tag->getName()){
                    $input->removeTag($tag);
                    $input->addTag($all);
                }
            }
        }
            $this->persister->insert($input);
            return $this->redirectToRoute('inputs_list');
         endif;

         return $this->render('Admin/Input/form/input-add.html.twig', [
             'form'=>$form->createView()
         ]);
    }

    /**
     * @Route("{slug}", name="inputs_show")
     */
    public function show(Input $input){
        return $this->render('Admin/Input/input-card.html.twig', [
            'input'=> $input
        ]);

    }

    /**
     * @Route("{slug}/update", name="inputs_update")
     */
    public function update(Request $request, Input $input){

    }

    /**
     * @Route("{slug}/delete", name="inputs_delete")
     */
    public function delete(Request $request, Input $input){

    }

}