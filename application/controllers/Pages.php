<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

    public function index()
    {
        if (!is_login()) return redirect('auth');

        $this->load->model('Mahasiswa_model', 'mahasiswa');
        $this->load->model('Keahlian_model', 'keahlian');
        $data = [
            'title' => 'Beranda',
            'sidebar' => ['dasbor'],
            'count' => [
                'mahasiswa' => $this->mahasiswa->count(),
                'keahlian' => $this->keahlian->count(null, 'keahlian'),
                'bidang' => $this->keahlian->count(),
            ]
        ];
        return view('pages.dashboard', $data);
    }
}
