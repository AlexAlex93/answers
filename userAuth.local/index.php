<?php
session_start();

use App\Models\Authentication\Cookie;
use App\Models\Authentication\Session;
use App\Models\User\Guest;
use App\Models\View;
use App\Models\Validator;
use App\Models\Authentication\Authentication;

require_once __DIR__ . '\autoload.php';

$view = new View;

$user_param_name = 'user';

if (isset($_GET['logout'])) {
     Authentication::logout($user_param_name, 'Location: \\');
}

$$user_param_name = Authentication::getCurrentUser();

if ( null != $$user_param_name ) {
    $view->assign($user_param_name, $$user_param_name)->display('header')->display('user')->display('footer');
}

if ( isset($_POST['lgn']) && isset($_POST['pswd']) ) {

    $login = Validator::validateRequestParameter($_POST['lgn']);
    $password = Validator::validateRequestParameter($_POST['pswd']);
    $$user_param_name = Authentication::checkPassword(new Guest($login, $password));

    if ($$user_param_name) {
         $cookie_flag = $_POST['remember_me'] === 'on';
         $data[$user_param_name] = $$user_param_name;
         Authentication::saveData($cookie_flag, $data);
    } else {
        Authentication::errorRegister();
    }
    header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
    exit();
}

if ( null == $$user_param_name ) {
    $auth_error = Authentication::getErrorIfExists();
    $view->assign($user_param_name, $$user_param_name)->assign('auth_error' , $auth_error )->display('header')->display('login')->display('footer');
}