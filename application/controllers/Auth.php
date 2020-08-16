<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Authorization_Token');
        $this->load->model("admin/Wisata_model", "WisataModel");
        $this->load->model('User_model');
        
    }
    

    public function index()
    {
        $data['login_button'] = $this->mylib->btngoogle();
        $this->load->view('login', $data);
        
    }
    public function logout()
    {
        include_once APPPATH . 'libraries/vendor/autoload.php';
        $google_client = new Google_Client();
        $google_client->setClientId('981383344271-44t68jekt07rb2noc7l698egdem74gvv.apps.googleusercontent.com');
        $google_client->setClientSecret('4SXgqoWow6Et9tQ7deEi2Ia1');
        $google_client->setRedirectUri('http://localhost/objekwisata/google_login/login');
        $google_client->revokeToken(); 
        
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('authenticated');
        redirect('auth');
    }
    function login()
    {
        $data = [
            'username' => $this->input->post('username', true),
            'password' => md5($this->input->post('password', true))
        ];
        $output = $this->User_model->get($data);        
        if(isset($output['message'])){
            $data['login_button'] = $this->mylib->btngoogle();
            $this->session->set_flashdata('pesan', $output['message'].', error');
            $this->load->view('login', $data);
        }else{
            $this->session->set_userdata('user_data', $output[0]);
            if($output[0]->jenis=='admin'){
                redirect('admin/home');
            }else{
                redirect('home');
            }
            
        }

    }
    
    function confirm($key)
    {
        $is_valid_token = $this->authorization_token->validateTokenPost($key);
        if ($is_valid_token['status'] === true) {
            $output = $this->User_model->confirm($is_valid_token['data']);
            if($output){
                $this->session->set_flashdata('pesan', 'Akun anda telah aktif silahkan login, success');
                redirect('auth');
            }else{
                $this->session->set_flashdata('pesan', 'Token aktivasi telah expire \n ajukan permintaan baru, error');
                redirect('auth');
            }
        }
    }

    
        
}
