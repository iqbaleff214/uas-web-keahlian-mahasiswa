<?php

if (!function_exists('csrf_field')) {
    function csrf_field()
    {
        $CI = &get_instance();
        return "<input type='hidden' name='" . $CI->security->get_csrf_token_name() . "' value='" . $CI->security->get_csrf_hash() . "'>";
    }
}

if (!function_exists('is_login')) {
    function is_login()
    {
        return isset($_SESSION['role']) ? true : false;
    }
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        return isset($_SESSION['role']) == 'admin' ? true : false;
    }
}
