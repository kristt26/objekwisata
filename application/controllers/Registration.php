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
        
        
            $UserToken = $this->authorization_token->generateToken($output);
            $dataa['token'] = $UserToken;
            $mesg = $this->load->view('template/mailverification',$dataa,true);
            if($this->send_mail($data['email'], $mesg)){
                $output = $this->UserModel->register($data);
                $this->session->set_flashdata('pesan', 'Registrasi Berhasil, success');
                redirect('Auth');
            }else{
                $this->session->set_flashdata('pesan', 'Registrasi Berhasil, success');
            }
    }

    function send_mail($to_email, $message)
    {
        // $message = base_url(). "auth/akt?ivasi/".$token;
        
        $from_email = "emailfortesting1011@gmail.com"; 
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'smtp.gmail.com';
        $config['smtp_crypto']    = 'ssl';
        $config['smtp_port']    = 465;
        $config['smtp_user']    = $from_email;
        $config['smtp_pass']    = 'stimik1011';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE;
        $this->load->library('email', $config);
         $this->email->from($from_email, 'admin Wisata'); 
         $this->email->to($to_email);
         $this->email->subject('Konfirmasi Akun'); 
         $this->email->message($message); 

         //Send mail 
         if($this->email->send()){
                return true;
         }else {
            $a = $this->email->print_debugger();
            return false;
         } 
    }
	
        
}
