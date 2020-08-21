<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Addwisata extends CI_Controller
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
        $Title = ['title'=>"Tambah Wisata", 'titledash'=>"Tambah Wisata"];
        $this->load->view('template/header', $Title);
        $this->load->view('admin/addwisata');
        $this->load->view('template/footer');
        
    }

    public function getdata($idwisata=null)
    {
        $data['wisata'] = $this->WisataModel->select();
        $data['kategori'] = $this->KategoriModel->select();
        echo json_encode($data);
    }

    public function getByid()
    {
        $data = $this->input->post();
        $data = $this->WisataModel->selectbyid($data);
        echo json_encode($data);
    }
    public function tambah()
    {
        $data = $_POST;
        $file = $this->upload();
        if (count($file) > 0) {
            $data['foto'] = $file['file'];
        }
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
        $data = $_POST;
        $cek = $this->WisataModel->selectfoto();
        $nilai;
        foreach ($cek as $key => $value) {
            if($value->idRencanaKerja==$idRencanaKerja)
                $nilai = $value;
        }
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
    public function upload($nilai=null)
    {
        
        $path_to_file = './assets/img/wisata/foto/' . $nilai->foto;
        $config['upload_path'] = './assets/img/wisata/foto/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 4096;
        $config['encrypt_name'] = true;
        if(isset($_FILES['file'])){
            if (isset($nilai->file)) {
                if (unlink($path_to_file)) {
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload("file")) {
                        $data = array('upload_data' => $this->upload->data());
                        $image = $data['upload_data']['file_name'];
                        // $result = $this->ProfileModel->updategambar($image);
                        return array('file' => $image);
                    }
                } else {
                    return [];
                }
            } else {
                $this->load->library('upload', $config);
                if ($this->upload->do_upload("file")) {
                    $data = array('upload_data' => $this->upload->data());
                    $image = $data['upload_data']['file_name'];
                    // $result = $this->ProfileModel->updategambar($image);
                    return array('file' => $image);
                }else{
                    $error = array('error' => $this->upload->display_errors());
                    $a=$error;
                }
            }
        }else{
            return array('file' => $nilai->file);
        }
    }
        
}
