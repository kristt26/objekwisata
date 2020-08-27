<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Kategori_model', 'KategoriModel');
        if(!$this->session->userdata('user_data'))
		{
			redirect('auth');
		}
    }

    public function index()
    {
        $Title = ['title'=>"Kategori Wisata", 'titledash'=>"Kategori Wisata"];
		
        $this->load->view('template/header', $Title);
        $this->load->view('admin/kategori');
        $this->load->view('template/footer');
    }

    public function getdata()
    {
        $data['kategori'] = $this->KategoriModel->select();
        echo json_encode($data['kategori']);
    }

    public function tambah()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        $output = $this->KategoriModel->insert($data);
        echo json_encode($output);
	}
	public function ubah()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        $output = $this->KategoriModel->update($data);
        echo json_encode($output);
	}
	public function hapus($id = null)
    {
		$output = $this->KategoriModel->delete($id);
        echo json_encode($output);
    }
}
