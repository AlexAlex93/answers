<?php


namespace App\Models;


class Validator
{
    public static function validateRequestParameter($request_parameter)
    {
        return trim(strip_tags($request_parameter));
    }
}