<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/Wisata_model", "WisataModel");
        $this->load->model('admin/Kategori_model', 'KategoriModel');
    }

    public function index()
    {
        if($this->session->userdata('authenticated'))
            redirect('page/welcome');
        $this->load->view('login');
        
    }

    public function getByid()
    {
        $data = $this->input->post();
        $data = $this->WisataModel->selectbyid($data);
        echo json_encode($data);
    }
    public function tambah()
    {
        $data = $this->input->post();
        $output = $this->WisataModel->insert($data);
        if($output){
            $this->session->set_flashdata('pesan', 'Berhasil di Tambahkan, success');
            redirect('admin/wisata');
        }else{
            $this->session->set_flashdata('pesan', 'Berhasil di Tambahkan, error');
            redirect('admin/wisata');
        }
        
        
	}
	public function ubah()
    {
        $data = $this->input->post();
        $output = $this->WisataModel->update($data);
        if ($output) {
            $this->session->set_flashdata('pesan', 'Berhasil di Ubah, success');
            redirect('admin/wisata');
        }else{
            $this->session->set_flashdata('pesan', 'Gagal di Ubah, error');
            redirect('admin/wisata');
        }
	}
	public function hapus()
    {
        $data = $this->input->post();
		$output = $this->WisataModel->delete($data);
		$this->session->set_flashdata('error', 'Berhasil di Ubah');
		redirect('admin/kategori');
        
    }
        
}
