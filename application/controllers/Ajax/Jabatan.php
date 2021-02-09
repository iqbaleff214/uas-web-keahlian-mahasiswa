<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jabatan_model', 'jabatan');
    }

    public function read($id = null)
    {
        $data = $this->jabatan->get($id);
        echo json_encode($data);
    }
}
