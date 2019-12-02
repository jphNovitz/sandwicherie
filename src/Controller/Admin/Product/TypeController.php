<?php

namespace App\Controller\Admin\Product;

use App\Entity\Type ;
use App\Form\TypeType;
use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
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
 * Class TypeController
 * @package App\Controller\Admin\Product
 * @Route("/admin/types/")
 * @Method({"GET"})
 */
class TypeController extends AbstractController
{
    protected $customPersister;
    protected $customLoader;
    protected $deleter;

    public function __construct(CustomPersister $customPersister,
                                CustomObjectLoader $customObjectLoader,
                                DeleteObject $deleter)
    {
        $this->customPersister = $customPersister;
        $this->customLoader = $customObjectLoader;
        $this->deleter = $deleter;
    }

    /**
     * @Route("", name="types_list")
     */
    public function index(Request $request)
    {
        $list = $this->customLoader->LoadAll('App:Type');
        if (!$list) {
            $this->addFlash('notice', "Aucun type trouvé !");
            return $this->redirectToRoute('types_add');
        }
        return $this->render($this->getParameter('adm_type').'types-list.html.twig', [
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
        return $this->render($this->getParameter('adm_type').'form/type_add.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("{slug}", name="types_show")
     */
    public function show(Request $request, $slug = null)
    {
        $type = $this->customLoader->LoadOne('App:Type', $slug);
        return $this->render($this->getParameter('adm_type').'type-card.html.twig', [
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
            $this->addFlash("error", "Ce type de produit n'existe pas ");
            return $this->redirectToRoute('types_add');
        }
        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($this->customPersister->update($type)):
                $this->addFlash("success",
                    $type->getName() . " a été modifiée !");
            else:
                $this->addFlash("error",
                    $type->getName() . " n'a pas pu être modifiée ");
            endif;
            return $this->redirectToRoute('types_update',[
                "slug"=>$type->getSlug()
            ]);
        endif;
        return $this->render($this->getParameter('adm_type').'form/type_update.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("{slug}/delete", name="types_delete")
     * @Method({"GET", "POST"})
     */
    public function delete(Request $request, Type $type = NULL )
    {
        if (!$type){
            $this->addFlash("error", "Type de produit inconnu");
            return $this->redirectToRoute('types_list');
        }
        $form = $this->createForm(DeleteType::class,null);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($form->get('oui')->isClicked()) {
                return $this->deleter->delete($type);
            }
            if ($form->get('non')->isClicked())
                return $this->redirectToRoute('types_list');

        endif;

        return $this->render('Admin/Product/Type/form/type-delete.html.twig',
            [
                'object' => $type,
                'form' => $form->createView()
            ]);
    }
}
