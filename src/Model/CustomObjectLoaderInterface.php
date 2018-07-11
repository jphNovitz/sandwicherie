<?php

namespace App\Model;

interface CustomObjectLoaderInterface {

    public function LoadOne(String $objetName, String $slug);

    public function LoadAll(String $objectName);

    public function CreateJsonResponse(String $objectname);
}