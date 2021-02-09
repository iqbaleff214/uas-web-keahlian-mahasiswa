<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{
    private $table = 'mahasiswa';
    private $id = 'mahasiswa_id';

    public function get($id = null, $keahlian = true)
    {
        if ($id) return $this->find($id, $keahlian);
        $this->db->order_by('nim');
        if ($keahlian) {
            $this->db->select("*");
            $this->db->join('keahlian', "keahlian.keahlian_id=$this->table.keahlian_id");
        }
        return $this->db->get($this->table)->result_array();
    }

    public function getLast($column = null)
    {
        $res = $this->db->order_by($this->id, 'DESC')->get($this->table)->row_array();
        return $column ? $res[$column] : $res;
    }

    public function getFirst($column = null)
    {
        $res = $this->db->order_by($this->id, 'ASC')->get($this->table)->row_array();
        return $column ? $res[$column] : $res;
    }

    public function find($id, $keahlian = true)
    {
        if (!$id) return $this->get($id, $keahlian);
        if ($keahlian) {
            $this->db->select("*");
            $this->db->join('keahlian', "keahlian.keahlian_id=$this->table.keahlian_id");
        }
        return $this->db->get_where($this->table, ["$this->table.$this->id" => $id])->row_array();
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

    public function count($table = null)
    {
        if (!$table) $table = $this->table;
        return $this->db->count_all_results($table);
    }
}
