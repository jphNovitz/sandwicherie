<?php

namespace App\Model;

interface CustomPersisterInterface {

    public function insert($obj) ;
    public function update($obj) ;

}