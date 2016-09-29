<?php

namespace App;


class UserFactory
{
    public function factory($rawDataUser)
    {
        $user = new User();
        $user->setName($rawDataUser[0]->name);
        $user->setEmail($rawDataUser[0]->email);
        $user->setPassword($rawDataUser[0]->password);
        return $user;
    }
}