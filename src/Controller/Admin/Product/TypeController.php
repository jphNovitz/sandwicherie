<?php

namespace App\Controller\Admin\Product;

use App\Entity\Type ;
use App\Form\TypeType;
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
 * Class TypeController
 * @package App\Controller\Admin\Product
 * @Route("/admin/types/")
 * @Method({"GET"})
 */
class TypeController extends Controller
{
    protected $customPersister;
    protected $customLoader;

    public function __construct(CustomPersister $customPersister, CustomObjectLoader $customObjectLoader)
    {
        $this->customPersister = $customPersister;
        $this->customLoader = $customObjectLoader;
    }

    /**
     * @Route("", name="types_list")
     */
    public function index(Request $request)
    {
        $list = $this->customLoader->LoadAll('App:Type');
        if (!$list) {
            $this->addFlash('notice', 'Il n\' y a aucune catégorie, je vous propose d\'en ajouter une');
            return $this->redirectToRoute('types_add');
        }
        return $this->render('Product/Type/types-list.html.twig', [
            'list'=>$list
        ]);
    }

    /**
     * @Route("new", name="types_add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request)
    {
        $type = new Type();
        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->insert($type)):
                $this->addFlash("success", $type->getName() . " a été créé avec succès !");
             else:
                 $this->addFlash("error", $type->getName() . " n'a pas pu être ajouté");
            endif;
            return $this->redirectToRoute('types_add');
        endif;
        return $this->render('Product/Type/form/type_add.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("{id}", name="types_show")
     */
    public function show(Request $request, $id = null)
    {
        $type = $this->customLoader->LoadOne('App:Type', $id);
        return $this->render('Product/Type/type-card.html.twig', [
            'type'=>$type
        ]);
    }



    /**
     * @Route("{slug}/update", name="types_update")
     * @Method({"GET", "POST"})
     */
    public function update(Request $request, Type $type= NULL )
    {
        if (!$type) {
            $this->addFlash("error", "Cette categorie n'existe pas ");
            return $this->redirectToRoute('types_add');
        }
        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->update($type)):
                $this->addFlash("success",
                    "La catégorie ". $type->getName() . " a été modifiée !");
            else:
                $this->addFlash("error",
                    "La catégorie ". $type->getName() . " n'a pas pu être modifiée ");
            endif;
            return $this->redirectToRoute('types_update',[
                "slug"=>$type->getSlug()
            ]);
        endif;
        return $this->render('Product/Type/form/type_update.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
