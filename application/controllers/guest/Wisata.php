<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wisata extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/Wisata_model", "WisataModel");
        $this->load->model("admin/Kategori_model", "KategoriModel");
    }

    public function index()
    {
        $Title = ['title' => "Event Wisata"];
        $data['wisata'] = $this->WisataModel->wisataonly();
        $this->load->view('guest/header', $Title);
        $this->load->view('guest/wisata', $data);
        $this->load->view('guest/footer');
    }

    public function readwisata($id = null)
    {
        $Title = ['title' => "Event Wisata"];
        // $data = array('content' => 'admin/koordinatjembatanform',
        //     'itemdatajembatan'=>$this->WisataModel->testing(),
        //     'itemkoordinatjembatan'=>$this->WisataModel->testing2());
        $this->load->view('guest/header', $Title);
        $this->load->view('guest/readwisata');
        $this->load->view('guest/footer');
    }

    public function getData($id = null)
    {
        $data['user'] = $this->session->userdata('user_data');
        $data['wisata'] = $this->WisataModel->selectone($id)[0];
        echo json_encode($data);
    }
    public function getDataWisata()
    {
        $data['user'] = $this->session->userdata('user_data');
        $data['wisata'] = $this->WisataModel->selectwisata();
        $data['kategori'] = $this->KategoriModel->select();
        echo json_encode($data);
    }
    public function simpan()
    {
        $data = $_POST;
        $file = $this->upload($data);
        $data['foto'] = $file['file'];
       
        $output = $this->WisataModel->insertmember($data);
        if ($output) {
            $this->session->set_flashdata('pesan', 'Berhasil di Tambahkan, success');
            redirect('admin/wisata');
        } else {
            $this->session->set_flashdata('pesan', 'Berhasil di Tambahkan, error');
            redirect('admin/wisata');
        }
    }
    public function upload()
    {
        $config['upload_path'] = './assets/img/wisata/foto';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 4096;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("file")) {
            $data = array('upload_data' => $this->upload->data());
            $image = $data['upload_data']['file_name'];
            // $result = $this->ProfileModel->updategambar($image);
            return array('file' => $image);
        } else {
            $error = array('error' => $this->upload->display_errors());
            return [];
        }
    }

}
