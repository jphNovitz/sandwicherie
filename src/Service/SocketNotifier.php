<?php

namespace App\Service;

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
use ElephantIO\EngineInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SocketNotifier {

    private $engine ;
    private $destination;
    public function __construct(ContainerInterface $container)
    {
        $this->destination = $container->getParameter('ngrok');
    }

    public function notify(String $type, Array $notification){

        $client = new Client(new Version2X($this->destination) );
        $client->initialize();
        $client->emit($type, [$type=>$notification]);
        $client->close();
        return true ;
    }


}