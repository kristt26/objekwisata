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
        $this->load->library('Authorization_Token');
        $data = $this->input->post();
        $data['password'] =  md5($data['password']);
        
        $output = $this->UserModel->register($data);
        if($output != false){
            $UserToken = $this->authorization_token->generateToken($output);
            $dataa['token'] = $UserToken;
            $mesg = $this->load->view('template/mailverification',$dataa,true);
            $this->send_mail($data['email'], $mesg);
            $this->session->set_flashdata('pesan', 'Registrasi Berhasil, success');
            redirect('Auth');
        }else{
            $this->session->set_flashdata('pesan', 'Registrasi Gagal, error');
            redirect('registration');
        }
    }

    function send_mail($to_email, $message)
    {
        // $message = base_url(). "auth/akt?ivasi/".$token;
        
        $from_email = "emailfortesting1011@gmail.com"; 
         $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => $from_email,
                'smtp_pass' => 'stimik1011',
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1'
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");   

         $this->email->from($from_email, 'admin Wisata'); 
         $this->email->to($to_email);
         $this->email->subject('Konfirmasi Akun'); 
         $this->email->message($message); 

         //Send mail 
         if($this->email->send()){
                return true;
         }else {
                return false;
         } 
    }
	
        
}
