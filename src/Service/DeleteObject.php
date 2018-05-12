<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;

class DeleteObject{
    protected  $router;
    protected  $session;
    protected  $customPersister;

    public function __construct(CustomPersister $customPersister, SessionInterface $session, RouterInterface $router)
    {
        $this->router = $router;
        $this->customPersister = $customPersister;
        $this->session = $session;
    }

    public function delete($obj){
        $claspath = explode('\\',get_class($obj));
        $class = strtolower($claspath[2]);
        if ($this->customPersister->delete($obj)) {
            $this->session->getFlashBag()->add('success', 'element supprimé');
            return new RedirectResponse($this->router->generate($class.'s_list'));
        }
        else {
            $this->session->getFlashBag()->add('error', 'Erreur');
            return new RedirectResponse($this->router->generate($class.'s_list'));
        }
    }
}