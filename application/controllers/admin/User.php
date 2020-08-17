<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/User_model', "UserModel");
        if(!$this->session->userdata('user_data'))
		{
			redirect('auth');
		}
    }
    

    public function index()
    {        
        $Title = ['title'=>"User", 'titledash'=>"User"];
        $this->load->view('template/header', $Title);
        $this->load->view('admin/user');
        $this->load->view('template/footer');
    }

    public function getdata()
    {
        $data = $this->UserModel->select();
        echo json_encode($data);
    }

    public function ubah()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        $output = $this->UserModel->update($data);
        echo json_encode($output);
    }
}

/* End of file Controllername.php */
