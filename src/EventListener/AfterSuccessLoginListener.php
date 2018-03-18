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
        $user->setTries(0);
        $this->persister->insert($user);

        $username = $user->getUsername();

        $this->session->getFlashBag()->add("info","bonjour ".$username);
        return new RedirectResponse($this->router->generate('admin_default'));

    }

}