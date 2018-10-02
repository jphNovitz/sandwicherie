<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class LoginController  extends Controller{

    /**
     * @Route("/clem_admin/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('Security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/api/login_check", name="login_check")
     */
    public function loginCheckAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/clem_admin/logout", name="logout")
     */
    public function logout(Request $request)
    {

    }


}