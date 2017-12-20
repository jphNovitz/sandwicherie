<?php

namespace App\Model;

interface CustomObjectLoaderInterface {

    public function LoadOne();

    public function LoadAll(String $objectName);

}