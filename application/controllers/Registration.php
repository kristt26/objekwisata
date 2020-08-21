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
        $data['password'] = md5($data['password']);
        $output = $this->UserModel->register($data);
        $UserToken = $this->authorization_token->generateToken($output);
        $dataa['token'] = $UserToken;
        $mesg = $this->load->view('template/mailverification', $dataa, true);
        $kirim = $this->send_mail($data['email'], $mesg);
        if ($kirim === true) {
            $this->session->set_flashdata('pesan', 'Registrasi Berhasil, success');
            redirect('Auth');
        } else {
            $this->session->set_flashdata('pesan', $kirim);
            redirect('registration');
        }
    }

    public function send_mail($to_email, $message)
    {
        // $message = base_url(). "auth/akt?ivasi/".$token;

        $from_email = "ajenkris@stimiksepnop.ac.id";
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'srv26.niagahoster.com';
        $config['smtp_crypto'] = 'ssl';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = 'stimik1011';
        $config['charset'] = 'iso-8859-1';
        $config['newline'] = "\r\n";
        $config['smtp_timeout'] = '7';
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = true;
        $this->load->library('email', $config);
        $this->email->from('emailfortesting1011@gmail.com', 'Wisata Jayapura');
        $this->email->to($to_email);
        $this->email->subject('Konfirmasi Akun');
        $this->email->message($message);

        //Send mail
        if ($this->email->send()) {
            return true;
        } else {
            $a = show_error($this->email->print_debugger());
            return $a;
        }
    }

}
