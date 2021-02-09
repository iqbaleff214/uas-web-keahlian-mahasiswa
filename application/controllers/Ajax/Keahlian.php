<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keahlian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Keahlian_model', 'keahlian');
    }

    public function read($id = null)
    {
        $data = $this->keahlian->get($id);
        echo json_encode($data);
    }
}
