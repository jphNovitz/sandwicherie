<?php
namespace App\Service;

use App\Entity\UserTemp;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserValidation {

    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function compare(UserTemp $model, User $test){

        if (($model->getEmail() !== $test->getEmail())
            ||
            ($model->getUsername() !== $test->getUsername())):
            return false;
        endif;
        return $this->encoder->isPasswordValid($model, $test->getPlainPassword());
    }
}