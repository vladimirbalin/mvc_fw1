<?php


namespace app\helpers;

class SessionHelper
{
    // flash('register_success', 'You are now registered and can log in')
    public static function flash($name = '', $message = '', $class = 'alert alert-success text-center')
    {
        if ($name) {
            if ($message) {
                if ($_SESSION[$name]) unset($_SESSION[$name]);
                if ($_SESSION[$name . '_class']) unset($_SESSION[$name . '_class']);
                $_SESSION[$name] = $message;
                $_SESSION[$name . '_class'] = $class;
            } elseif (!$message && $_SESSION[$name]) {
                $class = $_SESSION[$name . '_class'] ? $_SESSION[$name . '_class'] : '';
                echo "<div class='{$class}' id='msg-flash'>{$_SESSION[$name]}</div>";
                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_class']);
            }
        }
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }
}