<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keahlian_model extends CI_Model
{
    private $table = 'keahlian';
    private $id = 'keahlian_id';

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
        return $this->count($table) > 0;
    }

    public function count($table = null, $groupBy = null)
    {
        if (!$table) $table = $this->table;
        if ($groupBy) {
            $this->db->select($groupBy);
            $this->db->group_by("$this->table.$groupBy");
        }
        $this->db->from($table);
        return $this->db->get()->num_rows();
    }
}
