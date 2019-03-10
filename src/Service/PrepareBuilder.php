<?php

namespace App\Service;

use Hateoas\HateoasBuilder;
use Symfony\Component\HttpFoundation\Response;
class PrepareBuilder{

    public function prepare($result, $status){
        $hateoas = HateoasBuilder::create()->build();
        $json = $hateoas->serialize($result, 'json');
        $response = new Response($json, $status, array('application/json'));
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET');
        return $response;
    }
}