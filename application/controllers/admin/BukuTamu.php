<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bukutamu extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Bukutamu_model', 'BKModel');
        if(!$this->session->userdata('user_data'))
		{
			redirect('auth');
		}
    }

    public function index()
    {
        $Title = ['title'=>"Event Wisata", 'titledash'=>"Event"];
        $this->load->view('template/header', $Title);
        $this->load->view('admin/bukutamu');
        $this->load->view('template/footer');
    }
    public function getdata()
    {
        $result = $this->BKModel->select();
        echo json_encode($result);
    }
}