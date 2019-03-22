<?php

namespace App\Service;

use App\Model\PrepareBuilderInterface;
use Hateoas\HateoasBuilder;
use Symfony\Component\HttpFoundation\Response;
class PrepareBuilder implements PrepareBuilderInterface {

    public function prepare(String $result, Int $status){
        $hateoas = HateoasBuilder::create()->build();
        $json = $hateoas->serialize($result, 'json');
        $response = new Response($json, $status, array('application/json'));
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET');
        return $response;
    }
}