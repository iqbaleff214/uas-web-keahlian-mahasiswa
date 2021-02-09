<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keahlian extends CI_Controller
{
    private $class;

    public function __construct()
    {
        parent::__construct();
        if (!is_login()) return redirect('auth');
        if (!is_admin()) return redirect();

        $this->load->model('Keahlian_model', 'keahlian');
        $this->class = $this->router->fetch_class();
    }

    public function index()
    {
        $data = [
            'title' => 'Keahlian',
            'sidebar' => ['master', $this->class],
            'items' => $this->keahlian->get()
        ];
        return view('pages.keahlian.index', $data);
    }

    public function create()
    {

        $this->_validation();

        if ($this->form_validation->run()) return $this->_store();

        $data = [
            'title' => 'keahlian',
            'sidebar' => ['master', $this->class],
            'input' => [
                'keahlian' => ['label' => 'Keahlian*', 'type' => 'text'],
                'bidang' => ['label' => 'Bidang*', 'type' => 'text'],
                'keterangan' => ['label' => 'Keterangan', 'type' => 'textarea'],
            ]
        ];
        return view('layout.base.form', $data);
    }

    private function _store()
    {
        $data = $this->input->post();
        $res = $this->keahlian->insert($data);
        if ($res) {
            $this->session->set_flashdata('success', "Berhasil menambahkan $this->class!");
        } else {
            $this->session->set_flashdata('error', "Gagal menambahkan $this->class!");
        }

        return redirect($this->class);
    }

    public function edit($id = null)
    {
        if (!$id) return redirect($this->class);

        $this->_validation();

        if ($this->form_validation->run()) return $this->_update($id);

        $item = $this->keahlian->get($id);
        if (!$item) return redirect($this->class);

        $data = [
            'id' => $id,
            'title' => 'keahlian',
            'sidebar' => ['master', $this->class],
            'input' => [
                'keahlian' => ['label' => 'Keahlian*', 'type' => 'text', 'value' => $item['keahlian']],
                'bidang' => ['label' => 'Bidang*', 'type' => 'text', 'value' => $item['bidang']],
                'keterangan' => ['label' => 'Keterangan', 'type' => 'textarea', 'value' => $item['keterangan']],
            ]
        ];
        return view('layout.base.form', $data);
    }

    private function _update($id)
    {
        if (!$id) return redirect($this->class);

        $data = $this->input->post();
        $res = $this->keahlian->update($id, $data);
        if ($res) {
            $this->session->set_flashdata('success', "Berhasil mengubah $this->class!");
        } else {
            $this->session->set_flashdata('error', "Gagal mengubah $this->class!");
        }

        return redirect($this->class);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        if (!$id) return redirect($this->class);

        $res = $this->keahlian->delete($id);
        if ($res) {
            $this->session->set_flashdata('success', "Berhasil menghapus $this->class!");
        } else {
            $this->session->set_flashdata('error', "Gagal menghapus $this->class!");
        }

        return redirect($this->class);
    }

    private function _validation()
    {

        $this->form_validation->set_rules('keahlian', '', 'required');
        $this->form_validation->set_rules('bidang', '', 'required');
    }
}
