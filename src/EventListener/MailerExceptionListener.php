<?php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\Routing\RouterInterface;

class MailerExceptionListener{

    protected $session;
    protected $router;

    public function __construct(SessionInterface $session,
                                RouterInterface $router)
    {
        $this->session = $session;
        $this->router = $router;
    }

    public function onKernelException(GetResponseForExceptionEvent $event){
        $exception = $event->getException();
        if((!$exception instanceof \Swift_TransportException )
        || (!$exception instanceof \Swift_SwiftException )){
            return ;
        }
        $this->session->getFlashBag()->add('error', "Le message n'a pa pu être envoyé");
        return new RedirectResponse($this->router->generate('admin_default'));

    }

}