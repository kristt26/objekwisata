<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wisata extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/Wisata_model", "WisataModel");
    }

    function index()
    {
        $Title = ['title'=>"Event Wisata"];
        $data['wisata'] = $this->WisataModel->wisataonly();
        $this->load->view('guest/header', $Title);
        $this->load->view('guest/wisata', $data);
        $this->load->view('guest/footer');
    }

    function readwisata($id)
    {
        $Title = ['title'=>"Event Wisata"];
        $data['wisata'] = $this->WisataModel->selectone($id)[0];
        // $data = array('content' => 'admin/koordinatjembatanform',
		// 	'itemdatajembatan'=>$this->WisataModel->testing(),
		// 	'itemkoordinatjembatan'=>$this->WisataModel->testing2());
        $this->load->view('guest/header', $Title);
        $this->load->view('guest/readwisata', $data);
        $this->load->view('guest/footer');
    }
    
}