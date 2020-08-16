<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Kategori_model', 'KategoriModel');
		$this->load->model('admin/Wisata_model', 'WisataModel');
		$this->load->model('admin/Event_model', 'EventModel');
	}
	
	public function index()
	{
		$Title = ['title'=>"Home", 'titledash'=>"Dashboard"];
		$this->load->view('guest/header', $Title);
		$this->load->view('homedesk');
		$this->load->view('guest/footer');
	}
	
	public function getdata()
	{
		$data['event'] = $this->EventModel->eventonly();
		$data['kategori'] = $this->KategoriModel->select();
		$data['wisata'] = $this->WisataModel->selecthome();
		echo json_encode($data);
	}
}
