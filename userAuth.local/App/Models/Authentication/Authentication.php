<?php

namespace App\Models\Authentication;

use App\Models\Authentication\AuthenticationInterface;
use App\Models\User\User;

class Authentication implements AuthenticationInterface
{

    public static $users_list_path = __DIR__ . '\..\..\..\users.txt';
    public static $user = null;

    public static function userExists($new_user)
    {
        $users = self::getUserList();
        foreach ($users as $user) {
            if ($user->login === $new_user->login) {
                self::$user = $user;
                return true;
            }
        }
        return false;
    }

    public static function getUserList()
    {
        $users_list = file(self::$users_list_path);
        foreach ($users_list as $user) {
            $users[] = unserialize($user);
        }
        return $users;
    }

    public static function checkPassword($new_user)
    {
        if (self::userExists($new_user)) {
            if (password_verify($new_user->password, self::$user->password)) {
                return self::$user;
            }
        }
        return null;
    }

    public static function getCurrentUser(): ?User
    {
        if (isset($_COOKIE['user'])) {
            $user = unserialize($_COOKIE['user']);
        }

        if (isset($_SESSION['user'])) {
            $user = unserialize($_SESSION['user']);
        }

        return $user;
    }

    public static function logout($user_param_name, $header): void
    {
        if ( self::getCurrentUser()) {
            setcookie($user_param_name, '', 0);
            session_unset();
            session_destroy();
            header($header);
            exit();
        }
    }

    public static function saveData(bool $cookie_flag, array $data): void
    {
        if ($cookie_flag) {
            setcookie('user', serialize($data['user']), time() + $data['cookie_lifetime']);
        } else {
            $_SESSION['user'] = serialize($data['user']);
        }
    }

    public static function errorRegister()
    {
        $_SESSION['login_error_counter']++;
        if (3 == $_SESSION['login_error_counter']) {
            $_SESSION['login_error_counter'] = 0;
            $_SESSION['next_login_try'] = time() + 60;
        }
    }

    public static function getErrorIfExists(): ?string
    {
        if ($_SESSION['next_login_try'] >= time()) {
            return 'Попробуйте еще раз через '. ($_SESSION['next_login_try'] - time()) .' секунд';
        } else {
            unset($_SESSION['next_login_try']);
            return null;
        }
    }
}