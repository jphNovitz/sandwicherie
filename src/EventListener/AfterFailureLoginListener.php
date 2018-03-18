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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

class AfterFailureLoginListener implements AuthenticationFailureHandlerInterface {

    private $session;
    private $router;
    private $persister;
    private $loader;

    public function __construct(SessionInterface $session, RouterInterface $router, CustomPersister $persister, EntityManagerInterface $entityManager)
    {
        $this->session = $session;
        $this->router = $router;
        $this->persister = $persister;
        $this->loader = $entityManager;
    }


    /**
     * This is called when an interactive authentication attempt fails. This is
     * called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @return Response The response to return, never null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $failedUser = $this->loader->getRepository('App:User')
            ->findOneBy(['username'=>$exception->getToken()->getUser()]);
        $failedUser->setTries($failedUser->getTries()+1);
         $this->persister->insert($failedUser);
         return new RedirectResponse($this->router->generate('login'));
    }
}