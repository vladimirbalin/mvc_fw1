<?php
namespace app\helpers;

class UrlHelper
{
    public static function simple_redirect($str){
        header("Location: " . URL_ROOT . "/$str");
        exit;
    }
}