<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marker extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Marker_model');
    }
    
    public function index(){

    }

    public function simpan($id)
    {
        $data = $this->input->post();
        if($this->Marker_model->insert($data)){
            $this->session->set_flashdata('pesan', 'Berhasil Menambahkan Marker, success');
            redirect('guest/wisata/readwisata/'.$data['idwisata']);
        }
    }
    public function ambil($id)
    {
        $out = $this->Marker_model->select($id);
        echo json_encode($out);
    }
}
