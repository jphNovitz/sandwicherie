<?php
namespace App\EventListener;


use App\Service\CustomObjectLoader;
use App\Service\CustomPersister;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AfterSuccessLoginListener implements AuthenticationSuccessHandlerInterface {

    private $session;
    private $router;
    private $persister;

    public function __construct(SessionInterface $session, RouterInterface $router, CustomPersister $persister)
    {
        $this->session = $session;
        $this->router = $router;
        $this->persister = $persister;
    }

    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @return Response never null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $user = $token->getUser();
        $username = $user->getUsername();
        if ($username != 'admin') {
            if ($user->getIsActive()) :
                $user->setTries(0);
                $this->persister->insert($user);
                $this->session->getFlashBag()->add("info", "bonjour " . $username);
                if (in_array('ROLE_ADMIN', $user->getRoles())) :
                    return new RedirectResponse($this->router->generate('admin_default'));
                elseif (in_array('ROLE_MEMBER', $user->getRoles())) :
                    return new RedirectResponse($this->router->generate('admin_default'));
                elseif (in_array('ROLE_USER', $user->getRoles())) :
                    return new RedirectResponse($this->router->generate('default'));
                endif;
            else:
                $this->session->getFlashBag()->add("error", "Votre compte a été désactivé");
                return new RedirectResponse($this->router->generate('register'));
            endif;
        }
        return new RedirectResponse($this->router->generate('admin_default'));

    }

}