<?php 

namespace App\Models\User;

use App\Models\User\User;

abstract class User
{
    public $login;
    public $password;
    public $info;

    public function __construct($lgn, $psw, $info = null)
    {
        $this->login = $lgn;
        $this->password = $psw;
        $this->info = $info;
    }
}