<?php

namespace App\Models\Authentication;

interface AuthenticationInterface
{
    public static function userExists($user);
    public static function checkPassword($user);
    public static function getCurrentUser();
}