<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Event_model', 'EventModel');
        $this->load->model('admin/Wisata_model', 'WisataModel');
        if(!$this->session->userdata('user_data'))
		{
			redirect('auth');
		}
    }

    public function index()
    {
        $Title = ['title'=>"Event Wisata", 'titledash'=>"Event"];
        $this->load->view('template/header', $Title);
        $this->load->view('admin/event');
        $this->load->view('template/footer');
    }
    public function getdata()
    {
        $data['event'] = $this->EventModel->select();
        echo json_encode($data);
    }
    function add($idwisata= null, $idevent = null)
    {
        $Title = ['title'=>"Tambah Event Wisata", 'titledash'=>"Tambah Event"];
        if(is_null($idwisata)){
            $result = $this->EventModel->selectone($idwisata)[0];
            $result->jenis = 'event';
            $data['wisata'] =  $result;
            $data['title'] = 'Ubah';

            $this->load->view('template/header', $Title);
            $this->load->view('admin/eventadd', $data);
            $this->load->view('template/footer');
        }else{
            $result = $this->WisataModel->selectone($idwisata)[0];
            $result->jenis = 'wisata';
            $data['wisata'] = $result;
            $data['title'] = 'Tambah';
            $this->load->view('template/header', $Title);
            $this->load->view('admin/eventadd', $data);
            $this->load->view('template/footer');
        }
        
    }
    function tambah()
    {
        $data = $this->input->post();
        if($this->EventModel->insert($data)){
            $this->session->set_flashdata('pesan', 'Berhasil menambahkan, success');
            redirect('admin/event');
        }else{
            $this->session->set_flashdata('pesan', 'Gagal menambahkan, error');
            redirect('admin/event/add/'.$data['idwisata']);
        }
    }
    function ubah()
    {
        $data = $this->input->post();
        if($this->EventModel->update($data)){
            $this->session->set_flashdata('pesan', 'Berhasil mengubah event, success');
            redirect('admin/event');
        }else{
            $this->session->set_flashdata('pesan', 'Gagal mengubah event, error');
            redirect('admin/event/add/'.$data['idwisata']);
        }
    }
    function hapus($idevent = null)
    {
        $output = $this->EventModel->delete($idevent);
        if($output){
            $this->session->set_flashdata('pesan', 'Berhasil menghapus, success');
            redirect('admin/event');
        }else{
            $this->session->set_flashdata('pesan', 'Gagal menghapus, error');
            redirect('admin/event');
        }
		
    }
}