<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    private $class;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jabatan_model', 'jabatan');
        $this->class = $this->router->fetch_class();
    }

    public function index()
    {
        $data = [
            'title' => 'Jabatan',
            'sidebar' => ['master', $this->class],
            'items' => $this->jabatan->get()
        ];
        return view('pages.jabatan.index', $data);
    }

    public function create()
    {

        $this->_validation();

        if ($this->form_validation->run()) return $this->_store();

        $data = [
            'title' => 'Jabatan',
            'sidebar' => ['master', $this->class],
            'input' => [
                'jabatan' => ['label' => 'Jabatan*', 'type' => 'text'],
                'golongan' => ['label' => 'Golongan*', 'type' => 'text'],
                'gaji' => ['label' => 'Gaji*', 'type' => 'text'],
                'tunjangan' => ['label' => 'Jumlah Tunjangan*', 'type' => 'text'],
            ]
        ];
        return view('layout.base.form', $data);
    }

    private function _store()
    {
        $data = $this->input->post();
        $res = $this->jabatan->insert($data);
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

        $item = $this->jabatan->get($id);
        if (!$item) return redirect($this->class);

        $data = [
            'id' => $id,
            'title' => 'Jabatan',
            'sidebar' => ['master', $this->class],
            'input' => [
                'jabatan' => ['label' => 'Jabatan*', 'type' => 'text', 'value' => $item['jabatan']],
                'golongan' => ['label' => 'Golongan*', 'type' => 'text', 'value' => $item['golongan']],
                'gaji' => ['label' => 'Gaji*', 'type' => 'number', 'value' => $item['gaji']],
                'tunjangan' => ['label' => 'Jumlah Tunjangan*', 'type' => 'number', 'value' => $item['tunjangan']],
            ]
        ];
        return view('layout.base.form', $data);
    }

    private function _update($id)
    {
        if (!$id) return redirect($this->class);

        $data = $this->input->post();
        $res = $this->jabatan->update($id, $data);
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

        $res = $this->jabatan->delete($id);
        if ($res) {
            $this->session->set_flashdata('success', "Berhasil menghapus $this->class!");
        } else {
            $this->session->set_flashdata('error', "Gagal menghapus $this->class!");
        }

        return redirect($this->class);
    }

    private function _validation()
    {

        $this->form_validation->set_rules('jabatan', '', 'required');
        $this->form_validation->set_rules('golongan', '', 'required');
        $this->form_validation->set_rules('gaji', '', 'required|numeric');
        $this->form_validation->set_rules('tunjangan', '', 'required|numeric');
    }
}
