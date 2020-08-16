<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bukutamu extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Bukutamu_model");
    }

    function index()
    {
        $Title = ['title'=>"Buku Tamu"];
        $this->load->view('guest/header', $Title);
        $this->load->view('guest/bukutamu');
        $this->load->view('guest/footer');
    }

    function simpan()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        $output = $this->Bukutamu_model->insert($data);
        echo json_encode($output);
    }
}