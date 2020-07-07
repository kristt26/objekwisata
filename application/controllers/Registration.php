<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model", "UserModel");
    }

    public function index()
    {
        $this->load->view('register');
    }

 
    public function register()
    {
        $data = $this->input->post();
        $data['password'] =  md5($data['password']);
        $data['token'] = $this->mylib->randomchar();
        $output = $this->UserModel->register($data);
        if($output){
            $this->session->set_flashdata('pesan', 'Registrasi Berhasil, success');
            redirect('Auth');
        }else{
            $this->session->set_flashdata('pesan', 'Registrasi Gagal, error');
            redirect('registration');
        }
        
        
	}
	
        
}
