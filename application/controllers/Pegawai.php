<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    private $class;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model', 'pegawai');
        $this->class = $this->router->fetch_class();
    }

    public function index()
    {
        $data = [
            'title' => 'Pegawai',
            'sidebar' => ['master', $this->class],
            'items' => $this->pegawai->get()
        ];
        return view('pages.pegawai.index', $data);
    }

    public function create()
    {
        if (!$this->pegawai->hasRow('jabatan')) {
            $this->session->set_flashdata('info', "Isi data jabatan terlebih dahulu!");
            return redirect($this->class);
        }
        $this->_validation();

        if ($this->form_validation->run()) return $this->_store();
        $this->load->model('Jabatan_model', 'jabatan');

        $data = [
            'title' => 'Pegawai',
            'sidebar' => ['master', $this->class],
            'input' => [
                'nip' => ['label' => 'NIP**', 'type' => 'text'],
                'nama' => ['label' => 'Nama*', 'type' => 'text'],
                'jenis_kelamin' => ['label' => 'Jenis Kelamin*', 'type' => 'option', 'option-type' => 'enum', 'options' => ['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']],
                'jabatan_id' => ['label' => 'Jabatan*', 'type' => 'option', 'option-type' => 'database', 'options' => $this->jabatan->get()],
                'tempat_lahir' => ['label' => 'Tempat Lahir*', 'type' => 'text'],
                'tanggal_lahir' => ['label' => 'Tanggal Lahir*', 'type' => 'date'],
                'agama' => ['label' => 'Agama*', 'type' => 'text'],
                'alamat' => ['label' => 'Alamat*', 'type' => 'text'],
                'pendidikan' => ['label' => 'Pendidikan Terakhir*', 'type' => 'text'],
                'status' => ['label' => 'Status*', 'type' => 'text'],
                'no_hp' => ['label' => 'No. HP*', 'type' => 'text'],
            ]
        ];
        return view('layout.base.form', $data);
    }

    private function _store()
    {
        $data = $this->input->post();
        if (empty($data['nip'])) {
            $no = $this->pegawai->getLast('id');
            $no = $no ? intval($no)+1 : 1;
            $no = ($no < 10) ? "00$no" : (($no < 100) ? "0$no" : "$no");
            $data['nip'] = str_replace('-', '', $data['tanggal_lahir']).date('Ym').($data['jenis_kelamin'] == 'Laki-laki'? '1' : '2').$no;
        }
        $res = $this->pegawai->insert($data);
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

        $item = $this->pegawai->get($id);
        if (!$item) return redirect($this->class);
        
        $this->load->model('Jabatan_model', 'jabatan');

        $data = [
            'id' => $id,
            'title' => 'Pegawai',
            'sidebar' => ['master', $this->class],
            'input' => [
                'nip' => ['label' => 'NIP**', 'type' => 'text', 'value' => $item['nip'], 'readonly' => true],
                'nama' => ['label' => 'Nama*', 'type' => 'text', 'value' => $item['nama']],
                'jenis_kelamin' => ['label' => 'Jenis Kelamin*', 'type' => 'option', 'option-type' => 'enum', 'options' => ['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'], 'value' => $item['jenis_kelamin']],
                'jabatan_id' => ['label' => 'Jabatan*', 'type' => 'option', 'option-type' => 'database', 'options' => $this->jabatan->get(), 'value' => $item['jabatan_id']],
                'tempat_lahir' => ['label' => 'Tempat Lahir*', 'type' => 'text', 'value' => $item['tempat_lahir']],
                'tanggal_lahir' => ['label' => 'Tanggal Lahir*', 'type' => 'date', 'value' => $item['tanggal_lahir']],
                'agama' => ['label' => 'Agama*', 'type' => 'text', 'value' => $item['agama']],
                'alamat' => ['label' => 'Alamat*', 'type' => 'text', 'value' => $item['alamat']],
                'pendidikan' => ['label' => 'Pendidikan Terakhir*', 'type' => 'text', 'value' => $item['pendidikan']],
                'status' => ['label' => 'Status*', 'type' => 'text', 'value' => $item['status']],
                'no_hp' => ['label' => 'No. HP*', 'type' => 'text', 'value' => $item['no_hp']],
            ]
        ];
        return view('layout.base.form', $data);
    }

    private function _update($id)
    {
        if (!$id) return redirect($this->class);

        $data = $this->input->post();
        $res = $this->pegawai->update($id, $data);
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

        $res = $this->pegawai->delete($id);
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
        $this->form_validation->set_rules('jabatan_id', '', 'required');
        $this->form_validation->set_rules('nip', '', 'is_unique[personel.nip]');
        $this->form_validation->set_rules('jenis_kelamin', '', 'required|in_list[Laki-laki,Perempuan]');
        $this->form_validation->set_rules('agama', '', 'required');
        $this->form_validation->set_rules('alamat', '', 'required');
        $this->form_validation->set_rules('pendidikan', '', 'required');
        $this->form_validation->set_rules('status', '', 'required');
        $this->form_validation->set_rules('no_hp', '', 'required|numeric');
        $this->form_validation->set_rules('tempat_lahir', '', 'required');
        $this->form_validation->set_rules('tanggal_lahir', '', 'required');
    }
}
