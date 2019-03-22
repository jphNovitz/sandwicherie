<?php
namespace App\Model;

interface PrepareBuilderInterface{

    public function prepare(String $result, Int $status);
}