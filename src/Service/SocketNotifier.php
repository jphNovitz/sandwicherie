<?php

namespace App\Service;

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
use ElephantIO\EngineInterface;

class SocketNotifier {

    private $engine ;
    public function __construct()
    {

    }

    public function notify(String $type, Array $notification){
        $client = new Client(new Version2X('http://localhost:5000'));
        $client->initialize();
        $client->emit($type, ['notification'=>$notification]);
        $client->close();
    }


}