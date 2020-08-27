<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Addwisata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/Wisata_model", "WisataModel");
        $this->load->model('admin/Kategori_model', 'KategoriModel');
        if (!$this->session->userdata('user_data')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $Title = ['title' => "Tambah Wisata", 'titledash' => "Tambah Wisata"];
        $this->load->view('template/header', $Title);
        $this->load->view('admin/addwisata');
        $this->load->view('template/footer');

    }

    public function getdata($idwisata = null)
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
        $data['foto'] = "";
        $file = $this->upload();
        if (isset($file['file'])) {
            $data['foto'] = $file['file'];
            $output = $this->WisataModel->insert($data);
            if ($output) {
                $this->session->set_flashdata('pesan', 'Berhasil di Tambahkan, success');
                echo json_encode($file);
            } else {
                $this->session->set_flashdata('pesan', 'Berhasil di Tambahkan, error');
                echo json_encode($file);
            }
        }else{
            echo json_encode($file);
        }

    }
    public function ubah()
    {
        $data = $_POST;
        $cek = $this->WisataModel->selectfotowisata($data['idwisata']);
        $upload = $this->upload($cek);
        $data['foto'] = $upload['file'];
        $output = $this->WisataModel->update($data);
        if ($output) {
            echo json_encode($data);
        } else {
            echo json_encode(false);
        }
    }
    public function hapus()
    {
        $data = $this->input->post();
        $output = $this->WisataModel->delete($data);
        $this->session->set_flashdata('error', 'Berhasil di Ubah');
        redirect('admin/kategori');

    }
    public function upload()
    {
        $config['upload_path'] = './assets/img/wisata/foto/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 8096;
        $config['encrypt_name'] = true;
        if (isset($_FILES['file'])) {
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("file")) {
                $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
                // $result = $this->ProfileModel->updategambar($image);
                return array('file' => $image);
            } else {
                $error = array('error' => $this->upload->display_errors());
                $a = $error;
            }
        } else {
            return array('file' => $nilai->file);
        }
    }

}
