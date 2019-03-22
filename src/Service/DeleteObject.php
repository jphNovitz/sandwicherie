<?php
namespace App\Service;

use App\Model\DeleteObjectInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;

class DeleteObject implements DeleteObjectInterface {
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
        if (substr($class, -1)=='y'){
            $class = str_replace('y', 'ie', $class);
        }
        if ($this->customPersister->delete($obj)) {
            if ($class != 'usertemp') {
                $this->session->getFlashBag()->add('success', 'element supprimé');
                return new RedirectResponse($this->router->generate($class . 's_list'));
            }
        }
        else {
            $this->session->getFlashBag()->add('error', 'Erreur');
            return new RedirectResponse($this->router->generate($class.'s_list'));
        }
    }
}