<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{
    private $table = 'personel';
    private $id = 'id';

    public function get($id = null, $jabatan = true)
    {
        if ($id) return $this->find($id);
        if ($jabatan) {
            $this->db->select("$this->table.*, jabatan.jabatan, jabatan.golongan, jabatan.gaji, jabatan.tunjangan");
            $this->db->join('jabatan', "jabatan.id=$this->table.jabatan_id");
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

    public function find($id, $jabatan = true)
    {
        if (!$id) return $this->get();
        if ($jabatan) {
            $this->db->select("$this->table.*, jabatan.jabatan, jabatan.golongan, jabatan.gaji, jabatan.tunjangan");
            $this->db->join('jabatan', "jabatan.id=$this->table.jabatan_id");
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
