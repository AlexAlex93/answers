<?php 

spl_autoload_register('autoload');

function autoload($class_name) {
    require_once __DIR__ . '\\' . $class_name . '.php';
}