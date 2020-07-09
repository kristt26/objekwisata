<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/Event_model", "EventModel");
    }

    function readevent($id)
    {
        $Title = ['title'=>"Event Wisata"];
        $data['event'] = $this->EventModel->selectone($id)[0];
        $this->load->view('guest/header', $Title);
        $this->load->view('guest/readevent', $data);
        $this->load->view('guest/footer');

    }
    
}