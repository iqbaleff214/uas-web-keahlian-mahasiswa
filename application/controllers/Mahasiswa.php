<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    private $class;

    public function __construct()
    {
        parent::__construct();
        if (!is_login()) return redirect('auth');
        if (!is_admin()) return redirect();
        
        $this->load->model('Mahasiswa_model', 'mahasiswa');
        $this->class = $this->router->fetch_class();
    }

    public function index()
    {
        $data = [
            'title' => 'Mahasiswa',
            'sidebar' => ['master', $this->class],
            'items' => $this->mahasiswa->get(null, false)
        ];
        return view('pages.mahasiswa.index', $data);
    }

    public function create()
    {
        if (!$this->mahasiswa->hasRow('keahlian')) {
            $this->session->set_flashdata('info', "Isi data keahlian terlebih dahulu!");
            return redirect($this->class);
        }
        $this->_validation();

        if ($this->form_validation->run()) return $this->_store();
        $this->load->model('Keahlian_model', 'keahlian');

        $data = [
            'title' => 'Mahasiswa',
            'sidebar' => ['master', $this->class],
            'input' => [
                'nim' => ['label' => 'NIM*', 'type' => 'text'],
                'nama' => ['label' => 'Nama*', 'type' => 'text'],
                'jenis_kelamin' => ['label' => 'Jenis Kelamin*', 'type' => 'option', 'option-type' => 'enum', 'options' => ['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']],
                'keahlian_id' => ['label' => 'Keahlian*', 'type' => 'option', 'option-type' => 'database', 'options' => $this->keahlian->get()],
                'tempat_lahir' => ['label' => 'Tempat Lahir*', 'type' => 'text'],
                'tanggal_lahir' => ['label' => 'Tanggal Lahir*', 'type' => 'date'],
                'agama' => ['label' => 'Agama*', 'type' => 'text'],
                'alamat' => ['label' => 'Alamat*', 'type' => 'text'],
                'program_studi' => ['label' => 'Program Studi*', 'type' => 'text'],
                'no_hp' => ['label' => 'No. HP*', 'type' => 'text'],
            ]
        ];
        return view('layout.base.form', $data);
    }

    private function _store()
    {
        $data = $this->input->post();
        $res = $this->mahasiswa->insert($data);
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

        $item = $this->mahasiswa->get($id);
        if (!$item) return redirect($this->class);
        
        $this->load->model('Keahlian_model', 'keahlian');

        $data = [
            'id' => $id,
            'title' => 'Mahasiswa',
            'sidebar' => ['master', $this->class],
            'input' => [
                'nim' => ['label' => 'NIM*', 'type' => 'text', 'value' => $item['nim'], 'readonly' => true],
                'nama' => ['label' => 'Nama*', 'type' => 'text', 'value' => $item['nama']],
                'jenis_kelamin' => ['label' => 'Jenis Kelamin*', 'type' => 'option', 'option-type' => 'enum', 'options' => ['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'], 'value' => $item['jenis_kelamin']],
                'keahlian_id' => ['label' => 'Keahlian*', 'type' => 'option', 'option-type' => 'database', 'options' => $this->keahlian->get(), 'value' => $item['keahlian_id']],
                'tempat_lahir' => ['label' => 'Tempat Lahir*', 'type' => 'text', 'value' => $item['tempat_lahir']],
                'tanggal_lahir' => ['label' => 'Tanggal Lahir*', 'type' => 'date', 'value' => $item['tanggal_lahir']],
                'agama' => ['label' => 'Agama*', 'type' => 'text', 'value' => $item['agama']],
                'alamat' => ['label' => 'Alamat*', 'type' => 'text', 'value' => $item['alamat']],
                'program_studi' => ['label' => 'Program Studi*', 'type' => 'text', 'value' => $item['program_studi']],
                'no_hp' => ['label' => 'No. HP*', 'type' => 'text', 'value' => $item['no_hp']],
            ]
        ];
        return view('layout.base.form', $data);
    }

    private function _update($id)
    {
        if (!$id) return redirect($this->class);

        $data = $this->input->post();
        $res = $this->mahasiswa->update($id, $data);
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

        $res = $this->mahasiswa->delete($id);
        if ($res) {
            $this->session->set_flashdata('success', "Berhasil menghapus $this->class!");
        } else {
            $this->session->set_flashdata('error', "Gagal menghapus $this->class!");
        }

        return redirect($this->class);
    }

    private function _validation()
    {

        $this->form_validation->set_rules('nama', '', 'required');
        // $this->form_validation->set_rules('jabatan_id', '', 'required');
        $this->form_validation->set_rules('nim', '', 'is_unique[mahasiswa.nim]');
        $this->form_validation->set_rules('jenis_kelamin', '', 'required|in_list[Laki-laki,Perempuan]');
        $this->form_validation->set_rules('agama', '', 'required');
        $this->form_validation->set_rules('alamat', '', 'required');
        $this->form_validation->set_rules('program_studi', '', 'required');
        // $this->form_validation->set_rules('status', '', 'required');
        $this->form_validation->set_rules('no_hp', '', 'required|numeric');
        $this->form_validation->set_rules('tempat_lahir', '', 'required');
        $this->form_validation->set_rules('tanggal_lahir', '', 'required');
    }
}
