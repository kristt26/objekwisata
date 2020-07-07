<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Kategori_model', 'KategoriModel');

    }

    public function index()
    {
        $Title = ['title'=>"Kategori Wisata"];
		$data['kategori'] = $this->KategoriModel->select();
        $this->load->view('template/header', $Title);
        $this->load->view('admin/kategori', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Kategori Wisata', 'required', 'required');
        $data = $this->input->post();
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header');
			$this->load->view('admin/kategori');
			$this->load->view('template/footer');
        } else {
			$output = $this->KategoriModel->insert($data);
			$this->session->set_flashdata('pesan', 'Berhasil, di Tambahkan');
			redirect('admin/kategori');
        }
        
	}
	public function ubah()
    {
        $data = $this->input->post();
        $output = $this->KategoriModel->update($data);
        if ($output) {
            $this->session->set_flashdata('pesan', 'Berhasil di Ubah, success');
            redirect('admin/kategori');
        }else{
            $this->session->set_flashdata('pesan', 'Gagal di Ubah, error');
            redirect('admin/kategori');
        }
	}
	public function hapus()
    {
        $data = $this->input->post();
		$output = $this->KategoriModel->delete($data);
		$this->session->set_flashdata('pesan', 'Berhasil, di Ubah');
		redirect('admin/kategori');
        
    }
}
