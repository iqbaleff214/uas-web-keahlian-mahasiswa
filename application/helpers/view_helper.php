<?php

use Jenssegers\Blade\Blade;

if (!function_exists('view')) {
    function view($view, $data = [])
    {
        $viewDir = APPPATH . 'views';
        $cacheDir = APPPATH . 'cache';

        $blade = new Blade($viewDir, $cacheDir);
        echo $blade->make($view, $data);
    }
}

if (!function_exists('asset')) {
    function asset($url)
    {
        return base_url("public/$url");
    }
}

if (!function_exists('active_sidebar')) {
    function active_sidebar($link, $data)
    {
        return in_array($link, $data) ? 'menu-open active' : '';
    }
}

if (!function_exists('currency')) {
    function currency($value)
    {
        return 'Rp' . number_format($value, 2, ",", ".");
    }
}

if (!function_exists('null_field')) {
    function null_field($value)
    {
        return $value != null ? $value : '-';
    }
}

if (!function_exists('action_menu')) {
    function action_menu($id)
    {
        return "<div class=\"btn-group\">
        <button type=\"button\" class=\"btn btn-outline-success btn-xs dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
          <i class=\"fas fa-exclamation-circle\"></i>
        </button>
        <div class=\"dropdown-menu dropdown-menu-right\">
            <button class=\"dropdown-item view-item\" type=\"button\" data-id=\"$id\" data-toggle=\"modal\" data-target=\"#modalShow\">Lihat</button>
            <a class=\"dropdown-item\" href=\"" . current_url() . "/$id/edit\">Edit</a>
            <form action=\"" . current_url() . "/delete\" method=\"POST\">
                " . csrf_field() . "
                <input type=\"hidden\" value=\"$id\" name=\"id\">
                <button class=\"dropdown-item\" type=\"submit\" onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</button>
            </form>
        </div>
    </div>";
    }
}

if (!function_exists('message')) {
    function message($key = false)
    {
        $ci = &get_instance();
        if ($ci->session->flashdata('success')) {
            if ($key) return 'success';
            return $ci->session->flashdata('success');
        }
        if ($ci->session->flashdata('error')) {
            if ($key) return 'error';
            return $ci->session->flashdata('error');
        }
        if ($ci->session->flashdata('info')) {
            if ($key) return 'info';
            return $ci->session->flashdata('info');
        }
        return false;
    }
}
