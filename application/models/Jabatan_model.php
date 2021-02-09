<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan_model extends CI_Model
{
    private $table = 'jabatan';
    private $id = 'id';

    public function get($id = null)
    {
        if ($id) return $this->find($id);
        return $this->db->get($this->table)->result_array();
    }

    public function find($id)
    {
        if (!$id) return $this->get();
        return $this->db->get_where($this->table, [$this->id => $id])->row_array();
    }

    public function insert($data = [])
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id = null, $data = [])
    {
        if ($id) $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id = null)
    {
        if ($id) $this->db->where($this->id, $id);
        return $this->db->delete($this->table);
    }

    public function hasRow($table = null)
    {
        if (!$table) $table = $this->table;
        return $this->db->count_all_results($table) > 0;
    }
}
