<?php

if (!function_exists('csrf_field')) {
    function csrf_field()
    {
        $CI = &get_instance();
        return "<input type='hidden' name='" . $CI->security->get_csrf_token_name() . "' value='" . $CI->security->get_csrf_hash() . "'>";
    }
}
