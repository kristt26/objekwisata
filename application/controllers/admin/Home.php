<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('user_data'))
		{
			redirect('auth');
		}
    }

    public function index()
    {
        $Title = ['title'=>"Home", 'titledash'=>"Home"];
		// $data['model'] = $this->Home->select();
        $this->load->view('template/header', $Title);
        $this->load->view('admin/home');
        $this->load->view('template/footer');
    }
    public function getdata()
    {
        $this->load->model('admin/Home_model', 'HomeModel');
        $result = $this->HomeModel->select();
        echo json_encode($result);
    }
}