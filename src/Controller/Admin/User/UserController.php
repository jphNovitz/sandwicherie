<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Form\RoleType;
use App\Model\CustomPersisterInterface;
use App\Service\CustomObjectLoader;
use App\Model\CustomObjectLoaderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Service\DeleteObject;
use App\Form\DeleteType;

/**
 * Class UserController
 * @package App\Controller\Admin\User
 * @Route("/admin/users/")
 * @Method({"GET"})
 */
class UserController extends Controller
{
    protected $customPersister;
    protected $customLoader;
    protected $deleter;

    public function __construct(CustomPersisterInterface $customPersister,
                                CustomObjectLoader $customObjectLoader,
                                DeleteObject $deleter)
    {
        $this->customPersister = $customPersister;
        $this->customLoader = $customObjectLoader;
        $this->deleter = $deleter;
    }

    /**
     * @Route("", name="users_list")
     */
    public function index()
    {
        $users = $this->customLoader->LoadAll('App:User');

        if (!$users) {
            $this->addFlash("notice", "Aucun utilisateur ");
            return $this->redirectToRoute('admin_default');
        }
        return $this->render($this->getParameter('adm_user') . 'users-list.html.twig', ['users' => $users]);
    }

    /**
     * @Route("{username}", name="users_show")
     */
    public function show(User $user)
    {
        if (!$user) {
            $this->addFlash("notice", "Aucun utilisateur ");
            return $this->redirectToRoute('admin_default');
        }

        $orders = $this->get('doctrine.orm.default_entity_manager')
            ->getRepository('App:Cart')
            ->findOrdersByUser($user->getUsername());

        return $this->render($this->getParameter('adm_user') . 'user-card.html.twig', [
            'user' => $user,
            'orders' => $orders
        ]);
    }

    /**
     * @Route("delete/{username}", name="users_delete")
     * @Method({"GET", "POST"})
     */
    public function delete(Request $request, User $user)
    {
        if (!$user) {
            $this->addFlash("error", "Utilisateur inconnu");
            return $this->redirectToRoute('users_list');
        }

        $form = $this->createForm(DeleteType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('oui')->isClicked()) {
                return $this->deleter->delete($user);
            }
            if ($form->get('non')->isClicked())
                return $this->redirectToRoute('users_list');
        }

        return $this->render('Admin/User/form/user-delete.html.twig',
            [
                'object' => $user,
                'form' => $form->createView()
            ]);


    }

    /**
     * @Route("desactive/{username}", name="users_desactive")
     * @Method({"GET", "POST"})
     */
    public function desactive(Request $request, User $user)
    {
        if (!$user) {
            $this->addFlash("error", "Utilisateur inconnu");
            return $this->redirectToRoute('users_list');
        }

        $form = $this->createForm(DeleteType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('oui')->isClicked()) {
                $user->setIsActive(false);
                if ($this->customPersister->update($user)):
                    $this->addFlash('success', 'utilisateur désactivé');
                else:
                    $this->addFlash('success', 'L\'utilisateur n\'a pas pu être désactivé');
                endif;

                return $this->redirectToRoute('users_list');
            }
            if ($form->get('non')->isClicked())
                return $this->redirectToRoute('users_list');
        }

        return $this->render('Admin/User/form/user-desactive.html.twig',
            [
                'object' => $user,
                'form' => $form->createView()
            ]);


    }

    /**
     * @Route("reactive/{username}", name="users_reactive")
     * @Method({"GET", "POST"})
     */
    public function reactive(Request $request, User $user)
    {
        if (!$user) {
            $this->addFlash("error", "Utilisateur inconnu");
            return $this->redirectToRoute('users_list');
        }

        $form = $this->createForm(DeleteType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('oui')->isClicked()) {
                $user->setIsActive(true);
                if ($this->customPersister->update($user)):
                    $this->addFlash('success', 'utilisateur réactivé');
                else:
                    $this->addFlash('success', 'L\'utilisateur n\'a pas pu être réactivé');
                endif;

                return $this->redirectToRoute('users_list');
            }
            if ($form->get('non')->isClicked())
                return $this->redirectToRoute('users_list');
        }

        return $this->render('Admin/User/form/user-reactive.html.twig',
            [
                'object' => $user,
                'form' => $form->createView()
            ]);


    }

    /**
     * @Route("roles/{username}", name="users_roles")
     * @Method({"GET", "PUT"})
     */
    public function roleUser(Request $request, $username)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user = $this->get('doctrine.orm.default_entity_manager')
                    ->getRepository('App:User')
                    ->findOneBy(['username'=>$username]);

        $form = $this->createFormBuilder()
            ->add('roles', ChoiceType::class, [
                'choices'=>[
                    'ADMIN'=>'ROLE_ADMIN',
                    'STAFF (personnel)'=>'ROLE_MEMBER',
                    'UTILISATEUR (client)'=>'ROLE_USER',
                ],
                'expanded' => true,
                'multiple' => true,
                'data'=>$user->getRoles()
            ])
            ->setAction($this->generateUrl('users_roles', ['username'=>$user->getUsername()]))
            ->setMethod('PUT')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            $data = $form->get('roles')->getData();
            $user->setRoles($data);
            if ($this->customPersister->update($user)):
                $this->addFlash('success', 'Roles modifiés');
            else:
                $this->addFlash('error', 'Les Roles n\'ont pas pu être modifiés');
            endif;
            return $this->redirectToRoute('users_show', ['username'=>$user->getUsername()]);
        endif;

        return $this->render('Admin/User/form/user-roles.html.twig', ['form'=>$form->createView()]);

    }

}