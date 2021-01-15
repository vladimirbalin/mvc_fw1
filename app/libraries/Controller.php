<?php

namespace app\libraries;

class Controller
{
    public function render($view, $params = [])
    {
        if (file_exists("../app/views/$view.php")) {
            require_once "../app/views/$view.php";
        } else {
            die('no view');
        }
    }

}