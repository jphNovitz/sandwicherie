<?php

namespace App\Controller\Security;

use App\Entity\Recover;
use App\Entity\User;
use App\Entity\UserTemp;
use App\Form\RecoverType;
use App\Form\UserTempType;
use App\Form\UserType;
use App\Service\CustomPersister;
use App\Service\DeleteObject;
use App\Service\SendConfirmation;
use App\Service\UserValidation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SecurityController extends Controller {

    protected $persister;
    protected $encoder;
    protected $sendConfirmation ;
    public function __construct(CustomPersister $persister, SendConfirmation $sendConfirmation)
    {
        $this->persister = $persister;
        $this->sendConfirmation = $sendConfirmation;
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
        $userTemp = new UserTemp();

        $form = $this->createForm(UserTempType::class,$userTemp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()):
            if ($this->persister->insert($userTemp)){
                $this->addFlash('info', 'Inscription réussie, vous allez recevoir un mail de confirmation');
                $confirmation->send(
                    'info@laclementine.be',
                    $userTemp->getEmail(),
                    'Confirmation inscription',
                    'Security/emails/register-confirmation.html.twig',
                    $userTemp->getUniqId());

                return $this->redirectToRoute('admin_default');
            } else {
                $this->addFlash('error', 'Il y a eu problème avec votre inscription');
                return $this->render('Security/register.html.twig');
            }
        endif;
        return $this->render('Security/register.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/confirmation/{uniqId}", name="confirmation")
     */
    public function confirmation(Request $request, UserTemp $user, UserValidation $userValidation, CustomPersister $persister, DeleteObject $deleter, SendConfirmation $sendConfirmation)
    {
        if (!$user) {
            $this->addFlash("error", "utilisateur inconnu");
            $this->redirectToRoute('register');
        }
        $test = new User();
        $form = $this->createForm(UserType::class, $test);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()):
            if ($userValidation->compare($user,$test)){
                $test->setIsActive(true);
                if ($persister->insert($test)) {
                    $deleter->delete($user);
                    $sendConfirmation->send(
                        'info@laclementine.be',
                        $test->getEmail(),
                        'Compte activé',
                        'Security/emails/confirmation-notification.html.twig',
                        '');

                    $this->addFlash("success","Bienvenue parmis nos utilisateurs");
                    $this->redirectToRoute('default');
                } else {
                    $this->addFlash("error", "Votre compte n'a pas pu être validé à cause d'une etteur interne.");
                    $this->redirectToRoute('register');
                }
            } else {
                $this->addFlash("error", "Votre compte n'a pas pu être validé car les informations ne correspondent pas");
                $this->redirectToRoute('register');
            }

        endif;

        return $this->render('User/update-form.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("/recover", name="recover_pwd_ask")
     */
    public function reset(Request $request){

        $recover = new Recover();
        $form = $this->createForm(RecoverType::class,$recover);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()):
            if ($lost_user = $this->get('doctrine.orm.entity_manager')
                ->getRepository('App:User')
                ->findOneBy(['email'=>$form['email']->getData()])) {
                $this->sendConfirmation->send('info@laclementine.be',
                    $lost_user->getEmail(),
                    'Mot de passe perdu',
                    'Security/emails/recover-demand.html.twig',
                    $recover->getUniqId());
                $this->addFlash("info", "Vous allez revevoir un email");
                return $this->render('Security/emails/recover-message.html.twig');

            }

            return $this->redirectToRoute('default');


        endif;

        return $this->render('Security/recover.html.twig', ['form'=>$form->createView()]);

    }

}
