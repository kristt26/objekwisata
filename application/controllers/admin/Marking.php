<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marking extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Marking_model', 'MarkingModel');
        if(!$this->session->userdata('user_data'))
		{
			redirect('auth');
		}
    }

    public function index()
    {
        $Title = ['title'=>"Marking", 'titledash'=>"Marking"];
        $this->load->view('template/header', $Title);
        $this->load->view('admin/marking');
        $this->load->view('template/footer');
    }

    public function getdata()
    {
        $result = $this->MarkingModel->select();
        echo json_encode($result);
    }

	public function ubah()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        $output = $this->MarkingModel->update($data);
        echo json_encode($output);
    }
    
	public function hapus($id = null)
    {
        $result=$this->db->get_where('wisata', ['idwisata'=> $id])->row();
        $path = './assets/img/wisata/foto/' . $result->foto;
        if(unlink($path)){
            $output = $this->MarkingModel->delete($id);
            echo json_encode($output);
        }else{
            echo json_encode(false);
        }
        
    }
}
