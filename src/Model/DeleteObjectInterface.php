<?php

namespace App\Model;

use App\Service\CustomPersister;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;

interface DeleteObjectInterface {

    public function __construct(CustomPersister $customPersister, SessionInterface $session, RouterInterface $router);

    public function delete($obj);
}