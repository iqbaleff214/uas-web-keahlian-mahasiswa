<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    private $table = 'akun';
    private $id = 'akun_id';

    public function getUser($username)
    {
        $this->db->where('username', $username);
        return $this->db->get($this->table)->row_array();
    }

}
