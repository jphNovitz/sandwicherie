<?php

namespace App\Model;

interface CustomObjectLoaderInterface {

    public function LoadOne(String $objetName, Int $id);

    public function LoadAll(String $objectName);

}