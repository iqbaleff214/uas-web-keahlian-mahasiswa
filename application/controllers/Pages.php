<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

    public function index()
    {
        $this->load->model('Pegawai_model', 'pegawai');
        $data = [
            'title' => 'Beranda',
            'sidebar' => ['dasbor'],
            'count' => [
                'pegawai' => $this->pegawai->count()
            ]
        ];
        return view('pages.dashboard', $data);
    }
}
