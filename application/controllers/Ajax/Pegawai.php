<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model', 'pegawai');
    }

    public function read($id = null)
    {
        $data = $this->pegawai->get($id);
        echo json_encode($data);
    }
}
