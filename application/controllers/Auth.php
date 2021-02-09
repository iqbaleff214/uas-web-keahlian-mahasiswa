<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    private $class;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
        $this->class = $this->router->fetch_class();
    }

    public function index()
    {
        if (is_login()) return redirect();

        $this->_validation();

        if ($this->form_validation->run()) return $this->_login();

        return view('layout.auth');
    }

    public function logout()
    {
        if (!is_login()) return redirect('auth');

        if (isset($_SESSION['mahasiswa_id'])) unset($_SESSION['mahasiswa_id']);
        unset($_SESSION['role']);
        return redirect('auth');
    }

    private function _login()
    {
        $data = $this->input->post();

        $user = $this->auth->getUser($data['username']);

        if (!$user) {
            $this->session->set_flashdata('error', "Username tidak ditemukan!");
            return redirect($this->class);
        }

        if (!password_verify($data['password'], $user['password'])) {
            $this->session->set_flashdata('error', "Kata sandi tidak sesuai!");
            return redirect($this->class);
        }

        if ($user['mahasiswa_id']) {
            $_SESSION['role'] = 'mahasiswa';
            $_SESSION['id'] = $user['mahasiswa_id'];
        } else {
            $_SESSION['role'] = 'admin';
        }

        $this->session->set_flashdata('success', "Selamat datang, " . $user['username']);
        return redirect();
    }

    private function _validation()
    {
        $this->form_validation->set_rules('username', '', 'required');
        $this->form_validation->set_rules('password', '', 'required');
    }
}
