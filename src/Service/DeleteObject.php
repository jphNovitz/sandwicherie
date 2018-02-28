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
        if ($this->customPersister->delete($obj)) {
            $this->session->getFlashBag()->add('success', 'element supprimé');
            return new RedirectResponse($this->router->generate('ingredients_list'));
        }
        else {
            $this->session->getFlashBag()->add('error', 'Erreur');
            return new RedirectResponse($this->router->generate('ingredients_list'));
        }
    }
}