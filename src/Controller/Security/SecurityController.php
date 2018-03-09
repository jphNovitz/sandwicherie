<?php

namespace App\Controller\Security;

use App\Entity\UserTemp;
use App\Form\UserTempType;
use App\Service\CustomPersister;
use App\Service\SendConfirmation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller {

    protected $persister;

    public function __construct(CustomPersister $persister)
    {
        $this->persister = $persister;
    }

    /**
     * @Route("/login", name="login")
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
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request)
    {
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, SendConfirmation $confirmation)
    {
        $confirmation->send('sour@ce.com','dest@ina.tion','test', 'Security/register-confirmation.html.twig');
        return $this->render('Security/register-confirmation.html.twig');

        $userTemp = new UserTemp();
        $form = $this->createForm(UserTempType::class,$userTemp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()):
            if ($this->persister->insert($userTemp)){
                $this->addFlash('info', 'Inscription réussie, vous allez recevoir un mail de confirmation');
                return $this->render('Security/register-confirmation.html.twig');
            } else {
                $this->addFlash('error', 'Il y a eu problème avec votre inscription');
                return $this->render('Security/register.html.twig');
            }
        endif;
        return $this->render('Security/register.html.twig', [
            'form'=>$form->createView()
        ]);
    }


}
