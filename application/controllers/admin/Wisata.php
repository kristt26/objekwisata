<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wisata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/Wisata_model", "WisataModel");
        $this->load->model('admin/Kategori_model', 'KategoriModel');
        if(!$this->session->userdata('user_data'))
		{
			redirect('auth');
		}
    }

    public function index()
    {
        $Title = ['title'=>"Objek Wisata", 'titledash'=>"Objek Wisata"];
        $data['wisata'] = $this->WisataModel->select();
        $data['kategori'] = $this->KategoriModel->select();
        $this->load->view('template/header', $Title);
        $this->load->view('admin/wisata', $data);
        $this->load->view('template/footer');
        
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
