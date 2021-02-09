<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'mahasiswa');
    }

    public function read($id = null)
    {
        $data = $this->mahasiswa->get($id, false);
        echo json_encode($data);
    }

    public function read_all($id = null)
    {
        $data = $this->mahasiswa->get($id, true);
        echo json_encode($data);
    }
}
