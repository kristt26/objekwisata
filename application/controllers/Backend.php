<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	private $db2 = NULL;

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('laboratorium_lib');
		$this->load->library('form_validation');
		$this->load->model('user_model');
		$this->load->model('pembayaran_model');
		$this->load->model('keuangan_model');
		$this->load->model('pemasukan_model');
		$this->load->model('PostDana_model');
		$this->db2 = $this->load->database('db2', true);
		if($this->session->userdata('uid') == FALSE){
			redirect('');
		}
	}

	public function index()
	{
		$data = array();
		$this->load->view('header');
		$this->load->view('dashboard', $data);
		$this->load->view('footer');
	}

	// public function profile()
	// {
	// 	$data = array();
	// 	$data['data'] = $this->pembayaran_model->getPembayaranAsisten();
	// 	$this->load->view('header');
	// 	$this->load->view('bayar_asisten', $data);
	// 	$this->load->view('footer');
	// }

	


	public function bayar_asisten()
	{
		$data = array();
		$data['data'] = $this->pembayaran_model->getPembayaranAsisten();
		$this->load->view('header');
		$this->load->view('bayar_asisten', $data);
		$this->load->view('footer');
	}

	public function bayar_asisten_tambah()
	{
		$data = array();
		$data['ta'] = $this->laboratorium_lib->list_ta();
		$this->load->view('header');
		$this->load->view('bayar_asisten_add', $data);
		$this->load->view('footer');
	}

	public function bayar_asisten_add()
	{
		$kd_thn_ajaran = $this->input->post('kd_thn_ajaran');
		$kd_pengajar = $this->input->post('kd_pengajar');
		$kd_mk = $this->input->post('kd_mk');
		$nama_asisten = $this->laboratorium_lib->getNamaAsisten($kd_pengajar);

		$jumlah_mahasiswa = $this->laboratorium_lib->getJumlahKoutaAsisten($kd_pengajar,$kd_mk); 
		$tgl_pembayaran = $this->input->post('tgl_pembayaran');
		$pembayaran = $this->laboratorium_lib->getDataPembayaranAsisten();
		$besar_honor = $pembayaran->besar;
		$jumlah_honor = $jumlah_mahasiswa*$besar_honor;
		$kd_post_dana = $pembayaran->kd_dana;
		$post_dana = $pembayaran->keterangan;
		$status = 'T';

		$this->form_validation->set_rules('kd_thn_ajaran','Tahun Ajaran','required', array('required' => '%s tidak  boleh kosong'));
		
		$this->form_validation->set_rules('tgl_pembayaran','Tanggal','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('kd_mk','Matakuliah','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('kd_pengajar','Asisten','required', array('required' => '%s tidak  boleh kosong'));


		if($this->form_validation->run() == true){

    			$insert = array(
    				        'kd_thn_ajaran' => $kd_thn_ajaran,
							'tgl_pembayaran' => $tgl_pembayaran,
							'nama_asisten' => $nama_asisten,
							'jumlah_mahasiswa' => $jumlah_mahasiswa,
							'jumlah_honor' => $jumlah_honor,
							'status' => $status
				);

				$this->pembayaran_model->insertPembayaranAsisten($insert);

				$insert2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $post_dana,
								'posisi' => 'Kredit',
								'jumlah' => $jumlah_honor,
								'kd_kas' => $kd_post_dana.'-'.$this->laboratorium_lib->getIDPembayaranAsisten(),
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s')
				);

				$this->keuangan_model->insertKeuangan($insert2);
    			$this->session->set_flashdata('error', 'Pembayaran Honor Asisten berhasil diinput tanpa Nota');
				redirect('backend/bayar_asisten');
    		
		}else{
			$data = array();
			$data['ta'] = $this->laboratorium_lib->list_ta();
			$this->load->view('header');
			$this->load->view('bayar_asisten_add', $data);
			$this->load->view('footer');
		}
	}

	public function bayar_asisten_ubah($id)
	{
		$data = array();
		$data['ta'] = $this->laboratorium_lib->list_ta();
		$data['data'] = $this->pembayaran_model->selectPembayaranAsisten($id);
		$this->load->view('header');
		$this->load->view('bayar_asisten_update', $data);
		$this->load->view('footer');
	}

	public function bayar_asisten_update($id)
	{
		$kd_thn_ajaran = $this->input->post('kd_thn_ajaran');
		$tgl_pembayaran = $this->input->post('tgl_pembayaran');
		$nama_asisten = $this->input->post('nama_asisten');
		$jumlah_mahasiswa = $this->input->post('jumlah_mahasiswa');
		$pembayaran = $this->laboratorium_lib->getDataPembayaranAsisten();
		$besar_honor = $pembayaran->besar;
		$jumlah_honor = $jumlah_mahasiswa*$besar_honor;
		$kd_post_dana = $pembayaran->kd_dana;
		$post_dana = $pembayaran->keterangan;

		$this->form_validation->set_rules('kd_thn_ajaran','Tahun Ajaran','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('tgl_pembayaran','Tanggal','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('nama_asisten','Nama Asisten','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('jumlah_mahasiswa','Jumlah Mahasiswa','required', array('required' => '%s tidak  boleh kosong'));


		if($this->form_validation->run() == true){

			
				$update = array(
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'tgl_pembayaran' => $tgl_pembayaran,
								'nama_asisten' => $nama_asisten,
								'jumlah_mahasiswa' => $jumlah_mahasiswa,
								'jumlah_honor' => $jumlah_honor
				);

				$this->pembayaran_model->updatePembayaranAsisten($id,$update);

				$update2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $post_dana,
								'posisi' => 'Kredit',
								'jumlah' => $jumlah_honor,
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s')
				);

				$this->keuangan_model->updateKeuangan2($kd_post_dana.'-'.$id,$update2);
				$this->session->set_flashdata('error', 'Pembayaran Honor Asisten berhasil diupdate tanpa nota');
				redirect('backend/bayar_asisten');
			
		}else{
			$data = array();
			$data['ta'] = $this->laboratorium_lib->list_ta();
			$data['data'] = $this->pembayaran_model->selectPembayaranAsisten($id);
			$this->load->view('header');
			$this->load->view('bayar_asisten_update', $data);
			$this->load->view('footer');
		}
	}

	public function bayar_asisten_delete($id){
		$this->pembayaran_model->deletePembayaranAsisten($id);
		$this->keuangan_model->deleteKeuangan2('b1-'.$id);
		$nota = $this->laboratorium_lib->getNota2('b1-'.$id);
		if($nota!=''){
			unlink('./nota/b1/'.$nota);
		}
		$this->session->set_flashdata('success', 'Pembayaran Honor Asisten berhasil dihapus');
		redirect('backend/bayar_asisten');
	}

	public function bayar_penanggungjawab()
	{
		$data = array();
		$data['data'] = $this->pembayaran_model->getPembayaranPenanggungjawab();
		$this->load->view('header');
		$this->load->view('bayar_penanggungjawab', $data);
		$this->load->view('footer');
	}

	public function bayar_penanggungjawab_tambah()
	{
		$data = array();
		$data['ta'] = $this->laboratorium_lib->list_ta();

		$this->load->view('header');
		$this->load->view('bayar_penanggungjawab_add', $data);
		$this->load->view('footer');
	}

	public function bayar_penanggungjawab_add()
	{
		$kd_thn_ajaran = $this->input->post('kd_thn_ajaran');
		$kd_pengajar = $this->input->post('kd_penanggungjawab');
		$kd_mk = $this->input->post('kd_mk');
		$nama_penanggungjawab = $this->laboratorium_lib->getNamaPenanggungjawab($kd_pengajar);
		$jumlah_mahasiswa = $this->laboratorium_lib->getJumlahKoutaPenanggungjawab($kd_pengajar,$kd_mk);
		$tgl_pembayaran = $this->input->post('tgl_pembayaran');
		$pembayaran = $this->laboratorium_lib->getDataPembayaranPenanggungjawab();
		$besar_honor = $pembayaran->besar;
		$jumlah_honor = $jumlah_mahasiswa*$besar_honor;
		$kd_post_dana = $pembayaran->kd_dana;
		$post_dana = $pembayaran->keterangan;
		$status = 'T';

		$this->form_validation->set_rules('kd_thn_ajaran','Tahun Ajaran','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('tgl_pembayaran','Tanggal','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('kd_mk','Matakuliah','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('kd_penanggungjawab','Nama Penangungjawab','required', array('required' => '%s tidak  boleh kosong'));


		if($this->form_validation->run() == true){

				$insert = array(
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'tgl_pembayaran' => $tgl_pembayaran,
								'nama_penanggungjawab' => $nama_penanggungjawab,
								'jumlah_mahasiswa' => $jumlah_mahasiswa,
								'jumlah_honor' => $jumlah_honor,
								'status' => $status 
				);

				$this->pembayaran_model->insertPembayaranPenanggungjawab($insert);

				$insert2 = array(
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'tgl' => $tgl_pembayaran,
								'keterangan' => $post_dana,
								'posisi' => 'Kredit',
								'jumlah' => $jumlah_honor,
								'kd_kas' => $kd_post_dana.'-'.$this->laboratorium_lib->getIDPembayaranPenanggungjawab(),
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s')
				);
				var_dump($insert2);
				$this->keuangan_model->insertKeuangan($insert2);
				$this->session->set_flashdata('error', 'Pembayaran Honor Penanggung Jawab berhasil diinput tanpa nota');
				redirect('backend/bayar_penanggungjawab');
			
		}else{
			$data = array();
			$data['ta'] = $this->laboratorium_lib->list_ta();
			$this->load->view('header');
			$this->load->view('bayar_penanggungjawab_add', $data);
			$this->load->view('footer');
		}
	}

	public function bayar_penanggungjawab_ubah($id)
	{
		$data = array();
		$data['ta'] = $this->laboratorium_lib->list_ta();
		$data['data'] = $this->pembayaran_model->selectPembayaranPenanggungjawab($id);
		$this->load->view('header');
		$this->load->view('bayar_penanggungjawab_update', $data);
		$this->load->view('footer');
	}

	public function bayar_penanggungjawab_update($id)
	{
		$kd_thn_ajaran = $this->input->post('kd_thn_ajaran');
		$tgl_pembayaran = $this->input->post('tgl_pembayaran');
		$nama_penanggungjawab = $this->input->post('nama_penanggungjawab');
		$jumlah_mahasiswa = $this->input->post('jumlah_mahasiswa');
		$pembayaran = $this->laboratorium_lib->getDataPembayaranPenanggungjawab();
		$besar_honor = $pembayaran->besar;
		$jumlah_honor = $jumlah_mahasiswa*$besar_honor;
		$kd_post_dana = $pembayaran->kd_dana;
		$post_dana = $pembayaran->keterangan;

		$this->form_validation->set_rules('kd_thn_ajaran','Tahun Ajaran','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('tgl_pembayaran','Tanggal','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('nama_penanggungjawab','Nama Penanggung Jawab','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('jumlah_mahasiswa','Jumlah Mahasiswa','required', array('required' => '%s tidak  boleh kosong'));

		if($this->form_validation->run() == true){
			

				$update = array(
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'tgl_pembayaran' => $tgl_pembayaran,
								'nama_penanggungjawab' => $nama_penanggungjawab,
								'jumlah_mahasiswa' => $jumlah_mahasiswa,
								'jumlah_honor' => $jumlah_honor

				);

				$this->pembayaran_model->updatePembayaranPenanggungjawab($id,$update);

				$update2 = array(
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'tgl' => $tgl_pembayaran,
								'keterangan' => $post_dana,
								'posisi' => 'Kredit',
								'jumlah' => $jumlah_honor,
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s')
				);

				$this->keuangan_model->updateKeuangan2($kd_post_dana.'-'.$id,$update2);

				$this->session->set_flashdata('success', 'Pembayaran Honor Penanggungjawab berhasil diupdate tanpa nota');
				redirect('backend/bayar_penanggungjawab');
		}else{
			$data = array();
			$data['ta'] = $this->laboratorium_lib->list_ta();
			$data['data'] = $this->pembayaran_model->selectPembayaranPenanggungjawab($id);
			$this->load->view('header');
			$this->load->view('bayar_penanggungjawab_update', $data);
			$this->load->view('footer');
		}
	}

	public function bayar_penanggungjawab_delete($id){
		$this->pembayaran_model->deletePembayaranPenanggungjawab($id);
		$this->keuangan_model->deleteKeuangan2('b2-'.$id);
		if($this->laboratorium_lib->getNota2('b2-'.$id) != ''){
			unlink('./nota/b1/'.$this->laboratorium_lib->getNota2('b2-'.$id));
		}
		$this->session->set_flashdata('success', 'Pembayaran Honor Penanggung Jawab berhasil dihapus');
		redirect('backend/bayar_penanggungjawab');
	}

	function penanggungjawab(){
		$id = $this->input->post('id');
		$ta = $this->input->post('ta');
		$kabupaten = '<option value="">Pilih</pilih>';

		
		$kab=	$this->db2->query("SELECT
		jadwal_praktikum.*,
		pengajar.nama_pengajar
	  FROM
		jadwal_praktikum
		LEFT JOIN pengajar ON jadwal_praktikum.kd_penanggungjawab =
	  pengajar.kd_pengajar
	  where jadwal_praktikum.kd_thn_ajaran='$ta' and jadwal_praktikum.kd_mk='$id'
	  group by pengajar.kd_pengajar
	  " );
	
		foreach ($kab->result_array() as $data ){
			$kabupaten .= '<option value="'.$data['kd_penanggungjawab'].'">'.$data['nama_pengajar'].'</option>';
		}
		echo $kabupaten;
	}

	public function PostDana()
	{
		$data = array();
		$data = $this->PostDana_model->get();
		$this->load->view('header');
		$this->load->view('post_dana', $data);
		$this->load->view('footer');
	}

	public function PostDana_tambah()
	{
		$a = $_GET;
		$b = $a['status'];
		if($_GET['status']!="Simpan")
		{
			$a['data'] =  $this->PostDana_model->getOne($_GET['kd_dana']);
		}
		$this->load->view('header');
		$this->load->view('postdana_add', $a);
		$this->load->view('footer');
	}

	public function PostDana_add()
	{
		if($_GET['status']=="Simpan"){
			$data = array(
				'kd_dana' => $this->input->post('kd_dana'),
				'keterangan' => $this->input->post('keterangan'),
				'tipe' => $this->input->post('tipe'),
				'besar' => $this->input->post('besar'),
			);
			$this->PostDana_model->insert($data);
			redirect('backend/postDana');
		}else{
			$data = array(
				'keterangan' => $this->input->post('keterangan'),
				'tipe' => $this->input->post('tipe'),
				'besar' => $this->input->post('besar'),
			);
			$this->PostDana_model->update($this->input->post('kd_dana'), $data);
			redirect('backend/postDana');
		}
		
	}
	
	public function besaran()
	{
		$data = array();
		$data['ta'] = $this->laboratorium_lib->list_ta();
		$data['tahunajaran'] = "";
		$data['semester'] = "";
		// $a = $_POST['cari'];
		if(isset($_POST['cari'])){
			$ta=$_POST['ta'];
			$data['data'] = $this->pembayaran_model->getBesaranSearch($ta);
			foreach($data['ta'] as $struct) {
				if ($ta == $struct->kd_thn_ajaran) {
					$data['tahunajaran'] = $struct->thn_ajaran;
					$data['semester'] = $struct->semester;
					break;
				}
			}


		} else {
			$data['data'] = $this->pembayaran_model->getBesaran();
		}

	
	
	
		$this->load->view('header');
		$this->load->view('besaran', $data);
		$this->load->view('footer');
	}

	

	public function besaran_tambah()
	{
		$data = array();
		$data['ta'] = $this->laboratorium_lib->list_ta();
		$data['tipe'] = $this->laboratorium_lib->getKreditWithout();
		$this->load->view('header');
		$this->load->view('besaran_add', $data);
		$this->load->view('footer');
	}

	public function besaran_add()
	{
		$kd_thn_ajaran = $this->input->post('kd_thn_ajaran');
		$kd_dana = $this->input->post('kd_dana');
		$jumlah_mahasiswa = $this->laboratorium_lib->jumlahMahasiswa();
		$tgl_pembayaran = $this->input->post('tgl_pembayaran');
		$keterangan = $this->input->post('keterangan');
		$status = 'T';

		$this->form_validation->set_rules('kd_dana','Tipe','required', array('required' => '%s tidak  boleh kosong'));
		
		$this->form_validation->set_rules('tgl_pembayaran','Tanggal','required', array('required' => '%s tidak  boleh kosong'));

		if($this->form_validation->run() == true){
			echo $kd_dana;
			$data_dana = $this->laboratorium_lib->getPostDana($kd_dana);
			$jumlah_pembayaran = $jumlah_mahasiswa*$data_dana->besar;
			$config['upload_path']          = './nota/'.$kd_dana;
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['file_name']            = $kd_dana.'_'.date('YmdHis');
		    $config['overwrite']			= true;
		    $config['max_size']             = 2048; // 2MB
		    // $config['max_width']            = 1024;
		    // $config['max_height']           = 768;

		    $this->load->library('upload', $config);
		    if ($this->upload->do_upload('nota')) {
        		$nama_file = $this->upload->data("file_name");
				$insert = array(
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'tgl_pembayaran' => $tgl_pembayaran,
								'kd_dana' => $kd_dana,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan == '' ? $data_dana->keterangan : $keterangan,
								'status' => $status,
								'nota' => $nama_file
				);

				$this->pembayaran_model->insertBesaran($insert);

				$insert2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $data_dana->keterangan : $keterangan,
								'posisi' => 'Kredit',
								'jumlah' => $jumlah_pembayaran,
								'kd_kas' => $kd_dana.'-'.$this->laboratorium_lib->getIDBesaran(),
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s'),
								'nota' => $nama_file
				);

				$this->keuangan_model->insertKeuangan($insert2);

				$this->session->set_flashdata('success', 'Data Pengeluaran berhasil diinput');
				redirect('backend/besaran');
			} else {
				$data_dana = $this->laboratorium_lib->getPostDana($kd_dana);
			    $jumlah_pembayaran = $jumlah_mahasiswa*$data_dana->besar;
				$insert = array('kd_thn_ajaran' => $kd_thn_ajaran,
								'tgl_pembayaran' => $tgl_pembayaran,
								'kd_dana' => $kd_dana,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan == '' ? $data_dana->keterangan : $keterangan,
								'status' => $status
				);

				$this->pembayaran_model->insertBesaran($insert);

				$insert2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $data_dana->keterangan : $keterangan,
								'posisi' => 'Kredit',
								'jumlah' => $jumlah_pembayaran,
								'kd_kas' => $kd_dana.'-'.$this->laboratorium_lib->getIDBesaran(),
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s')
				);

				$this->keuangan_model->insertKeuangan($insert2);
				$this->session->set_flashdata('error', 'Data Pengeluaran berhasil diinput tanpa Nota');
				redirect('backend/besaran');
			}
		}else{
			$data = array();
			$data['tipe'] = $this->laboratorium_lib->getKreditWithout();
			$this->load->view('header');
			$this->load->view('besaran_add', $data);
			$this->load->view('footer');
		}
	}

	public function besaran_ubah($id)
	{
		$data = array();
		$data['tipe'] = $this->laboratorium_lib->getKreditWithout();
		$data['data'] = $this->pembayaran_model->selectBesaran($id);
		$this->load->view('header');
		$this->load->view('besaran_update', $data);
		$this->load->view('footer');
	}

	public function besaran_update($id)
	{
		$kd_dana = $this->input->post('kd_dana');
		// var_dump($kd_dana);
		// $kd_kas = $kd_dana.'-'.$id;
		// $kd_keuangan = $this->laboratorium_lib->getIDKeuangan($kd_kas); 
		$jumlah_pembayaran = $this->input->post('jumlah_pembayaran');
		$tgl_pembayaran = $this->input->post('tgl_pembayaran');
		$keterangan = $this->input->post('keterangan');
		$nota_lama = $this->input->post('nota_lama');

		$this->form_validation->set_rules('tgl_pembayaran','Tanggal','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('jumlah_pembayaran','Jumlah Pembayaran','required', array('required' => '%s tidak  boleh kosong'));


		if($this->form_validation->run() == true){
			if($nota_lama != '' && $_FILES['nota']['name'] !=''){
				unlink('./nota/'.$kd_dana.'/'.$nota_lama);
			}

			$config['upload_path']          = './nota/'.$kd_dana;
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['file_name']            = $kd_dana.'_'.date('YmdHis');
		    $config['overwrite']			= true;
		    $config['max_size']             = 2048; // 2MB
		    // $config['max_width']            = 1024;
		    // $config['max_height']           = 768;

		    $this->load->library('upload', $config);
		    if ($this->upload->do_upload('nota')) {
        		$nama_file = $this->upload->data("file_name");
				$update = array(
								'tgl_pembayaran' => $tgl_pembayaran,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan,
								'nota' => $nama_file
				);

				$this->pembayaran_model->updateBesaran($id,$update);

				$update2 = array(
								'tgl' => $tgl_pembayaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'jumlah' => $jumlah_pembayaran,
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s'),
								'nota' => $nama_file
				);

				$this->keuangan_model->updateKeuangan2($kd_dana.'-'.$id, $update2);

				$this->session->set_flashdata('success', 'Data Pengeluaran berhasil diupdate');
				redirect('backend/besaran');
			} else {
				$this->session->set_flashdata('error', 'Nota Pembayaran gagal diupload');
				redirect('backend/besaran');
			}
		}else{
			$data = array();
			$data['data'] = $this->pembayaran_model->selectBesaran($id);
			$data['tipe'] = $this->laboratorium_lib->getKreditWithout();
			$this->load->view('header');
			$this->load->view('besaran_update', $data);
			$this->load->view('footer');
		}
	}

	public function besaran_delete($id){
		$data = $this->pembayaran_model->selectBesaran($id);
		$this->pembayaran_model->deleteBesaran($id);
		$this->keuangan_model->deleteKeuangan2($data->kd_dana.'-'.$id);
		if($this->laboratorium_lib->getNota2($data->kd_dana.'-'.$id) != ''){
			unlink('./nota/'.$data->kd_dana.'/'.$this->laboratorium_lib->getNota2($data->kd_dana.'-'.$id));
		}
		$this->session->set_flashdata('success', 'Data Pengeluaran berhasil dihapus');
		redirect('backend/besaran');
	}

	public function pemasukan()
	{
		$data = array();
		$data['ta'] = $this->laboratorium_lib->list_ta();
		$data['data']=[];
		if(isset($_POST['cari'])){
			$ta=$_POST['ta'];
			$data['data'] = $this->pemasukan_model->getPemasukanSearch($ta);
		} else {
			$data['data'] = $this->pemasukan_model->getPemasukan();
		}

		$this->load->view('header');
		$this->load->view('pemasukan', $data);
		$this->load->view('footer');
	}

	public function pemasukan_tambah()
	{
		$data = array();
		$dataTemp= $this->laboratorium_lib->getDebet();
		$datas=[];
		foreach ($dataTemp as $key => $value) {
			if($value->kd_dana=='b6' || $value->kd_dana=='b7'){
				array_push($datas,$value);
			}
		}
		$data['tipe']=$datas;
		$data['tahunajaran'] = $this->laboratorium_lib->list_ta();
		$this->load->view('header');
		$this->load->view('pemasukan_add', $data);
		$this->load->view('footer');
	}

	public function pemasukan_add()
	{
		$kd_dana = $this->input->post('kd_dana');
		$kd_thn_ajaran = $this->input->post('kd_thn_ajaran');
		$tgl_pemasukan = $this->input->post('tgl_pemasukan');
		$jumlah_pemasukan = $this->input->post('jumlah_pemasukan');
		$keterangan = $this->input->post('keterangan');
		
		$data_dana = $this->laboratorium_lib->getPostDana($kd_dana);
	
		$status = 'T';

		$this->form_validation->set_rules('kd_dana','Tipe','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('tgl_pemasukan','Tanggal','required', array('required' => '%s tidak  boleh kosong'));

		if($kd_dana == 'b7' ||$kd_dana == 'b6'){
			$this->form_validation->set_rules('jumlah_pemasukan','Jumlah Pemasukan','required', array('required' => '%s tidak  boleh kosong'));
		}
		
		if($this->form_validation->run() == true){
			$config['upload_path']          = './nota/'.$kd_dana;
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['file_name']            = $kd_dana.'_'.date('YmdHis');
		    $config['overwrite']			= true;
		    $config['max_size']             = 2048; // 2MB
		    // $config['max_width']            = 1024;
		    // $config['max_height']           = 768;

		    $this->load->library('upload', $config);
		    if ($this->upload->do_upload('nota')) {
        		$nama_file = $this->upload->data("file_name");
				$insert = array(
								'tgl_pemasukan' => $tgl_pemasukan,
								'kd_dana' => $kd_dana,
								'jumlah_pemasukan' => $jumlah_pemasukan,
								'keterangan' => $keterangan,
								'status' => $status,
								'nota' => $nama_file,'kd_thn_ajaran'=>$kd_thn_ajaran
				);

				$this->pemasukan_model->insertPemasukan($insert);

				$insert2 = array(
								'tgl' => $tgl_pemasukan,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'posisi' => 'Debet',
								'jumlah' => $jumlah_pemasukan,
								'kd_kas' => $kd_dana.'-'.$this->laboratorium_lib->getIDPemasukan(),
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s'),
								'nota' => $nama_file
				);

				$this->keuangan_model->insertKeuangan($insert2);

				$this->session->set_flashdata('success', 'Pemasukan berhasil diinput');
				redirect('backend/pemasukan');
			} else {
				$insert = array(
								'tgl_pemasukan' => $tgl_pemasukan,
								'kd_dana' => $kd_dana,
								'jumlah_pemasukan' => $jumlah_pemasukan,
								'keterangan' => $keterangan,
								'status' => $status,
								'kd_thn_ajaran'=>$kd_thn_ajaran
				);

				$this->pemasukan_model->insertPemasukan($insert);

				$insert2 = array(
								'tgl' => $tgl_pemasukan,
								'kd_thn_ajaran' => $this->laboratorium_lib->getIDTahunAjaran(),
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'posisi' => 'Debet',
								'jumlah' => $jumlah_pemasukan,
								'kd_kas' => $kd_dana.'-'.$this->laboratorium_lib->getIDPemasukan(),
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s')
				);

				$this->keuangan_model->insertKeuangan($insert2);
				$this->session->set_flashdata('error', 'Pemasukan berhasil diinput tanpa Nota');
				redirect('backend/pemasukan');
			}
		}else{
			$data = array();
			$data['tipe'] = $this->laboratorium_lib->getDebet();
			$this->load->view('header');
			$this->load->view('pemasukan_add', $data);
			$this->load->view('footer');
		}
	}

	public function pemasukan_ubah($id)
	{
		$data = array();
		$data['tipe'] = $this->laboratorium_lib->getDebet();
		$data['data'] = $this->pemasukan_model->selectPemasukan($id);
		$this->load->view('header');
		$this->load->view('pemasukan_update', $data);
		$this->load->view('footer');
	}

	public function pemasukan_update($id)
	{
		$kd_dana = $this->input->post('kd_dana');
		$jumlah_pemasukan = $this->input->post('jumlah_pemasukan');
		$tgl_pemasukan = $this->input->post('tgl_pemasukan');
		$keterangan = $this->input->post('keterangan');
		$nota_lama = $this->input->post('nota_lama');

		$this->form_validation->set_rules('tgl_pemasukan','Tanggal','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('jumlah_pemasukan','Jumlah Pemasukan','required', array('required' => '%s tidak  boleh kosong'));

		if($this->form_validation->run() == true){
			if($nota_lama != '' && $_FILES['nota']['name'] !=''){
				unlink('./nota/'.$kd_dana.'/'.$nota_lama);
			}
			$config['upload_path']          = './nota/'.$kd_dana;
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['file_name']            = $kd_dana.'_'.date('YmdHis');
		    $config['overwrite']			= true;
		    $config['max_size']             = 2048; // 2MB
		    // $config['max_width']            = 1024;
		    // $config['max_height']           = 768;

		    $this->load->library('upload', $config);
		    if ($this->upload->do_upload('nota')) {
        		$nama_file = $this->upload->data("file_name");
				$update = array(
								'tgl_pemasukan' => $tgl_pemasukan,
								'jumlah_pemasukan' => $jumlah_pemasukan,
								'keterangan' => $keterangan,
								'nota' => $nama_file
				);

				$this->pemasukan_model->updatePemasukan($id,$update);

				$update2 = array(
								'tgl' => $tgl_pemasukan,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'jumlah' => $jumlah_pemasukan,
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s'),
								'nota' => $nama_file
				);

				$this->keuangan_model->updateKeuangan2($kd_dana.'-'.$id, $update2);

				$this->session->set_flashdata('success', 'Pemasukan berhasil diupdate');
				redirect('backend/pemasukan');
			} else {
				$update = array(
								'tgl_pemasukan' => $tgl_pemasukan,
								'jumlah_pemasukan' => $jumlah_pemasukan,
								'keterangan' => $keterangan
				);

				$this->pemasukan_model->updatePemasukan($id,$update);

				$update2 = array(
								'tgl' => $tgl_pemasukan,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'jumlah' => $jumlah_pemasukan,
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s')
				);

				$this->keuangan_model->updateKeuangan2($kd_dana.'-'.$id, $update2);
				$this->session->set_flashdata('error', 'Pemasukan berhasil diupdate tanpa Nota');
				redirect('backend/pemasukan');
			}
		}else{
			$data = array();
			$data['data'] = $this->pemasukan_model->selectPemasukan($id);
			$data['tipe'] = $this->laboratorium_lib->getDebet();
			$this->load->view('header');
			$this->load->view('pemasukan_update', $data);
			$this->load->view('footer');
		}
	}

	public function pemasukan_delete($id){
		$data = $this->pemasukan_model->selectPemasukan($id);
		$this->pemasukan_model->deletePemasukan($id);
		$this->keuangan_model->deleteKeuangan2($data->kd_dana.'-'.$id);
		if($this->laboratorium_lib->getNota2($data->kd_dana.'-'.$id) != ''){
			unlink('./nota/'.$data->kd_dana.'/'.$this->laboratorium_lib->getNota2($data->kd_dana.'-'.$id));
		}
		$this->session->set_flashdata('success', 'Pemasukan berhasil dihapus');
		redirect('backend/pemasukan');
	}

	public function laboran()
	{
		$data = array();
		$data['ta'] = $this->laboratorium_lib->list_ta();$ta=0;
		if(isset($_POST['cari'])){
			$ta=$_POST['ta'];
			$data['data'] = $this->pembayaran_model->getLaboranSearch($_POST['ta']);
		} else {
			$data['data'] = $this->pembayaran_model->getLaboran();
		}

		$data['tahunajaran'] = "";
		$data['semester'] = "";
		foreach($data['ta'] as $struct) {
			if ($ta == $struct->kd_thn_ajaran) {
				$data['tahunajaran'] = $struct->thn_ajaran;
				$data['semester'] = $struct->semester;
				break;
			}
		}
		
		$this->load->view('header');
		$this->load->view('laboran', $data);
		$this->load->view('footer');
	}

	public function laboran_tambah()
	{
		$data = array();
		$data['tipe'] = 'b10';
		$data['ta'] = $this->laboratorium_lib->list_ta();
		$this->load->view('header');
		$this->load->view('laboran_add', $data);
		$this->load->view('footer');
	}

	public function laboran_add()
	{
		$kd_thn_ajaran = $this->input->post('kd_thn_ajaran');
		$kd_dana = $this->input->post('kd_dana');
		$data_dana = $this->laboratorium_lib->getPostDana($kd_dana);
		$jumlah_pembayaran = $this->input->post('jumlah_pembayaran');
		$tgl_pembayaran = $this->input->post('tgl_pembayaran');
		$keterangan = $this->input->post('keterangan') != '' ? $this->input->post('keterangan') : $data_dana->keterangan;
		$status = 'T';

		$this->form_validation->set_rules('kd_thn_ajaran','Tahun Ajaran','required', array('required' => '%s tidak  boleh kosong'));
		
		$this->form_validation->set_rules('kd_dana','Tipe','required', array('required' => '%s tidak  boleh kosong'));
		
		$this->form_validation->set_rules('tgl_pembayaran','Tanggal','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('jumlah_pembayaran','Jumlah Pembayaran','required', array('required' => '%s tidak  boleh kosong'));


		if($this->form_validation->run() == true){
			$config['upload_path']          = './nota/'.$kd_dana;
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['file_name']            = $kd_dana.'_'.date('YmdHis');
		    $config['overwrite']			= true;
		    $config['max_size']             = 2048; // 2MB
		    // $config['max_width']            = 1024;
		    // $config['max_height']           = 768;

		    $this->load->library('upload', $config);
		    if ($this->upload->do_upload('nota')) {
        		$nama_file = $this->upload->data("file_name");
				$insert = array(
								'tgl_pembayaran' => $tgl_pembayaran,
								'kd_dana' => $kd_dana,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan,
								'status' => $status,
								'nota' => $nama_file,
								'kd_thn_ajaran' => $kd_thn_ajaran
				);

				$this->pembayaran_model->insertBesaran($insert);

				$insert2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'posisi' => 'Kredit',
								'jumlah' => $jumlah_pembayaran,
								'kd_kas' => $kd_dana.'-'.$this->laboratorium_lib->getIDBesaran(),
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s'),
								'nota' => $nama_file
				);

				$this->keuangan_model->insertKeuangan($insert2);

				$this->session->set_flashdata('success', 'Pembayaran Laboran berhasil diinput');
				redirect('backend/laboran');
			} else {
				$insert = array(
								'tgl_pembayaran' => $tgl_pembayaran,
								'kd_dana' => $kd_dana,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan,
								'status' => $status,
								'kd_thn_ajaran' => $kd_thn_ajaran
				);

				$this->pembayaran_model->insertBesaran($insert);

				$insert2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'posisi' => 'Kredit',
								'jumlah' => $jumlah_pembayaran,
								'kd_kas' => $kd_dana.'-'.$this->laboratorium_lib->getIDBesaran(),
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s')
				);

				$this->keuangan_model->insertKeuangan($insert2);
				$this->session->set_flashdata('error', 'Pembayaran Laboran berhasil diinput tanpa Nota');
				redirect('backend/laboran');
			}
		}else{
			$data = array();
			$data['tipe'] = 'b10';
			$data['ta'] = $this->laboratorium_lib->list_ta();
			$this->load->view('header');
			$this->load->view('laboran_add', $data);
			$this->load->view('footer');
		}
	}

	public function laboran_ubah($id)
	{
		$data = array();
		$data['tipe'] = 'b10';
		$data['ta'] = $this->laboratorium_lib->list_ta();
		$data['data'] = $this->pembayaran_model->selectBesaran($id);
		$this->load->view('header');
		$this->load->view('laboran_update', $data);
		$this->load->view('footer');
	}

	public function laboran_update($id)
	{
		$kd_dana = $this->input->post('kd_dana');
		$kd_thn_ajaran = $this->input->post('kd_thn_ajaran');
		$jumlah_pembayaran = $this->input->post('jumlah_pembayaran');
		$tgl_pembayaran = $this->input->post('tgl_pembayaran');
		$keterangan = $this->input->post('keterangan');
		$nota_lama = $this->input->post('nota_lama');

		$this->form_validation->set_rules('kd_thn_ajaran','Tahun Ajaran','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('tgl_pembayaran','Tanggal','required', array('required' => '%s tidak boleh kosong'));

		$this->form_validation->set_rules('jumlah_pembayaran','Jumlah Pembayaran','required', array('required' => '%s tidak  boleh kosong'));


		if($this->form_validation->run() == true){
			if($nota_lama != '' && $_FILES['nota']['name'] != ''){
				unlink('./nota/'.$kd_dana.'/'.$nota_lama);
			}
			$config['upload_path']          = './nota/'.$kd_dana;
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['file_name']            = $kd_dana.'_'.date('YmdHis');
		    $config['overwrite']			= true;
		    $config['max_size']             = 2048; // 2MB
		    // $config['max_width']            = 1024;
		    // $config['max_height']           = 768;

		    $this->load->library('upload', $config);
		    if ($this->upload->do_upload('nota')) {
        		$nama_file = $this->upload->data("file_name");
				$update = array(
								'tgl_pembayaran' => $tgl_pembayaran,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan,
								'nota' => $nama_file,
								'kd_thn_ajaran' => $kd_thn_ajaran
				);

				$this->pembayaran_model->updateBesaran($id,$update);

				$update2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'jumlah' => $jumlah_pembayaran,
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s'),
								'nota' => $nama_file
				);

				$this->keuangan_model->updateKeuangan2($kd_dana.'-'.$id, $update2);

				$this->session->set_flashdata('success', 'Pembayaran Laboran berhasil diupdate');
				redirect('backend/laboran');
			} else {
				$update = array(
								'tgl_pembayaran' => $tgl_pembayaran,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan,
								'kd_thn_ajaran' => $kd_thn_ajaran
				);

				$this->pembayaran_model->updateBesaran($id,$update);

				$update2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'jumlah' => $jumlah_pembayaran,
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s')
				);
				$this->keuangan_model->updateKeuangan2($kd_dana.'-'.$id, $update2);
				$this->session->set_flashdata('error', 'Pembayaran Laboran berhasil diupdate tanpa Nota');
				redirect('backend/laboran');
			}
		}else{
			$data = array();
			$data['data'] = $this->pembayaran_model->selectBesaran($id);
			$data['tipe'] = 'b10';
			$data['ta'] = $this->laboratorium_lib->list_ta();
			$this->load->view('header');
			$this->load->view('laboran_update', $data);
			$this->load->view('footer');
		}
	}

	public function laboran_delete($id){
		$data = $this->pembayaran_model->selectBesaran($id);
		$this->pembayaran_model->deleteBesaran($id);
		$this->keuangan_model->deleteKeuangan2($data->kd_dana.'-'.$id);
		if($this->laboratorium_lib->getNota2($data->kd_dana.'-'.$id) != ''){
			unlink('./nota/'.$data->kd_dana.'/'.$this->laboratorium_lib->getNota2($data->kd_dana.'-'.$id));
		}
		$this->session->set_flashdata('success', 'Pembayaran Laboran berhasil dihapus');
		redirect('backend/laboran');
	}

	public function operasional()
	{
		$data = array();
		$data['ta'] = $this->laboratorium_lib->list_ta();

		$ta=0;
		if(isset($_POST['cari'])){
			$ta=$_POST['ta'];
			$data['data'] = $this->pembayaran_model->getOperasionalSearch($_POST['ta']);	
		} else {
			$data['data'] = $this->pembayaran_model->getOperasional();
		}
		
		$data['tahunajaran'] = "";
		$data['semester'] = "";
		foreach($data['ta'] as $struct) {
			if ($ta == $struct->kd_thn_ajaran) {
				$data['tahunajaran'] = $struct->thn_ajaran;
				$data['semester'] = $struct->semester;
				break;
			}
		}

		$this->load->view('header');
		$this->load->view('operasional', $data);
		$this->load->view('footer');
	}

	public function operasional_tambah()
	{
		$data = array();
		$data['tipe'] = 'b11';
		$data['ta'] = $this->laboratorium_lib->list_ta();
		$this->load->view('header');
		$this->load->view('operasional_add', $data);
		$this->load->view('footer');
	}

	public function operasional_add()
	{
		$kd_dana = $this->input->post('kd_dana');
		$kd_thn_ajaran = $this->input->post('kd_thn_ajaran');
		$data_dana = $this->laboratorium_lib->getPostDana($kd_dana);
		$jumlah_pembayaran = $this->input->post('jumlah_pembayaran');
		$tgl_pembayaran = $this->input->post('tgl_pembayaran');
		$keterangan = $this->input->post('keterangan') != '' ? $this->input->post('keterangan') : $data_dana->keterangan;
		$status = 'T';

		$this->form_validation->set_rules('kd_thn_ajaran','Tahun Ajaran','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('kd_dana','Tipe','required', array('required' => '%s tidak  boleh kosong'));
		
		$this->form_validation->set_rules('tgl_pembayaran','Tanggal','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('jumlah_pembayaran','Jumlah Pembayaran','required', array('required' => '%s tidak  boleh kosong'));


		if($this->form_validation->run() == true){
			$config['upload_path']          = './nota/'.$kd_dana;
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['file_name']            = $kd_dana.'_'.date('YmdHis');
		    $config['overwrite']			= true;
		    $config['max_size']             = 2048; // 2MB
		    // $config['max_width']            = 1024;
		    // $config['max_height']           = 768;

		    $this->load->library('upload', $config);

		     if ($this->upload->do_upload('nota')) {
        		$nama_file = $this->upload->data("file_name");
				$insert = array(
								'tgl_pembayaran' => $tgl_pembayaran,
								'kd_dana' => $kd_dana,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan,
								'status' => $status,
								'kd_thn_ajaran' => $kd_thn_ajaran
				);

				$this->pembayaran_model->insertBesaran($insert);

				$insert2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'posisi' => 'Kredit',
								'jumlah' => $jumlah_pembayaran,
								'kd_kas' => $kd_dana.'-'.$this->laboratorium_lib->getIDBesaran(),
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s')
				);

				$this->keuangan_model->insertKeuangan($insert2);

				$this->session->set_flashdata('success', 'Pembayaran Operasional berhasil diinput');
				redirect('backend/operasional');
			} else {
				$insert = array(
								'tgl_pembayaran' => $tgl_pembayaran,
								'kd_dana' => $kd_dana,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan,
								'kd_thn_ajaran' => $kd_thn_ajaran
				);

				$this->pembayaran_model->insertBesaran($insert);

				$insert2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'posisi' => 'Kredit',
								'jumlah' => $jumlah_pembayaran,
								'kd_kas' => $kd_dana.'-'.$this->laboratorium_lib->getIDBesaran(),
								'kd_akun_updated' => $this->session->userdata('uid')
				);

				$this->keuangan_model->insertKeuangan($insert2);
				$this->session->set_flashdata('error', 'Nota Pembayaran Operasional gagal diupload');
				redirect('backend/operasional');
			}
		}else{
			$data = array();
			$data['tipe'] = 'b11';
			$data['ta'] = $this->laboratorium_lib->list_ta();
			$this->load->view('header');
			$this->load->view('operasional_add', $data);
			$this->load->view('footer');
		}
	}

	public function operasional_ubah($id)
	{
		$data = array();
		$data['tipe'] = 'b11';
		$data['ta'] = $this->laboratorium_lib->list_ta();
		$data['data'] = $this->pembayaran_model->selectBesaran($id);
		$this->load->view('header');
		$this->load->view('operasional_update', $data);
		$this->load->view('footer');
	}

	public function operasional_update($id)
	{
		$kd_dana = $this->input->post('kd_dana');
		$kd_thn_ajaran = $this->input->post('kd_thn_ajaran');
		$jumlah_pembayaran = $this->input->post('jumlah_pembayaran');
		$tgl_pembayaran = $this->input->post('tgl_pembayaran');
		$keterangan = $this->input->post('keterangan');
		$nota_lama = $this->input->post('nota_lama');

		$this->form_validation->set_rules('kd_thn_ajaran','Tahun Ajaran','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('tgl_pembayaran','Tanggal','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('jumlah_pembayaran','Jumlah Pembayaran','required', array('required' => '%s tidak  boleh kosong'));


		if($this->form_validation->run() == true){
			if($nota_lama != '' && $_FILES['nota']['name'] != ''){
				unlink('./nota/'.$kd_dana.'/'.$nota_lama);
			}
			$config['upload_path']          = './nota/'.$kd_dana;
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['file_name']            = $kd_dana.'_'.date('YmdHis');
		    $config['overwrite']			= true;
		    $config['max_size']             = 2048; // 2MB
		    // $config['max_width']            = 1024;
		    // $config['max_height']           = 768;

		    $this->load->library('upload', $config);

		     if ($this->upload->do_upload('nota')) {
        		$nama_file = $this->upload->data("file_name");
				$update = array(
								'tgl_pembayaran' => $tgl_pembayaran,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan,
								'nota' => $nama_file,
								'kd_thn_ajaran' => $kd_thn_ajaran
				);

				$this->pembayaran_model->updateBesaran($id,$update);

				$update2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'jumlah' => $jumlah_pembayaran,
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s'),
								'nota' => $nama_file
				);

				$this->keuangan_model->updateKeuangan2($kd_dana.'-'.$id, $update2);

				$this->session->set_flashdata('success', 'Pembayaran Operasional berhasil diupdate');
				redirect('backend/operasional');
			} else {
				$update = array(
								'tgl_pembayaran' => $tgl_pembayaran,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan,
								'kd_thn_ajaran' => $kd_thn_ajaran
				);

				$this->pembayaran_model->updateBesaran($id,$update);

				$update2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'jumlah' => $jumlah_pembayaran,
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s')
				);

				$this->keuangan_model->updateKeuangan2($kd_dana.'-'.$id, $update2);
				$this->session->set_flashdata('error', 'Pembayaran Operasional berhasil diupdate tanpa Nota');
				redirect('backend/operasional');
			}
		}else{
			$data = array();
			$data['data'] = $this->pembayaran_model->selectBesaran($id);
			$data['tipe'] = 'b11';
			$data['ta'] = $this->laboratorium_lib->list_ta();
			$this->load->view('header');
			$this->load->view('operasional_update', $data);
			$this->load->view('footer');
		}
	}

	public function operasional_delete($id){
		$data = $this->pembayaran_model->selectBesaran($id);
		$this->pembayaran_model->deleteBesaran($id);
		$this->keuangan_model->deleteKeuangan2($data->kd_dana.'-'.$id);
		if($this->laboratorium_lib->getNota2($data->kd_dana.'-'.$id) != ''){
			unlink('./nota/'.$data->kd_dana.'/'.$this->laboratorium_lib->getNota2($data->kd_dana.'-'.$id));
		}
		$this->session->set_flashdata('success', 'Pembayaran Operasional berhasil dihapus');
		redirect('backend/operasional');
	}

	public function maintance()
	{
		$data = array();
		$data['ta'] = $this->laboratorium_lib->list_ta();
		if(isset($_POST['cari'])){
			$data['data'] = $this->pembayaran_model->getMaintanceSearch($_POST['ta']);
		} else {
			$data['data'] = $this->pembayaran_model->getMaintance();
		}
		
		$this->load->view('header');
		$this->load->view('maintance', $data);
		$this->load->view('footer');
	}

	public function maintance_tambah()
	{
		$data = array();
		$data['tipe'] = 'b12';
		$data['ta'] = $this->laboratorium_lib->list_ta();
		$this->load->view('header');
		$this->load->view('maintance_add', $data);
		$this->load->view('footer');
	}

	public function maintance_add()
	{
		$kd_dana = $this->input->post('kd_dana');
		$kd_thn_ajaran = $this->input->post('kd_thn_ajaran');
		$data_dana = $this->laboratorium_lib->getPostDana($kd_dana);
		$jumlah_pembayaran = $this->input->post('jumlah_pembayaran');
		$tgl_pembayaran = $this->input->post('tgl_pembayaran');
		$keterangan = $this->input->post('keterangan') != '' ? $this->input->post('keterangan') : $data_dana->keterangan;
		
		$status = 'T';

		$this->form_validation->set_rules('kd_thn_ajaran','Tahun Ajaran','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('kd_dana','Tipe','required', array('required' => '%s tidak  boleh kosong'));
		
		$this->form_validation->set_rules('tgl_pembayaran','Tanggal','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('jumlah_pembayaran','Jumlah Pembayaran','required', array('required' => '%s tidak  boleh kosong'));

		
		if($this->form_validation->run() == true){
			$config['upload_path']          = './nota/'.$kd_dana;
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['file_name']            = $kd_dana.'_'.date('YmdHis');
		    $config['overwrite']			= true;
		    $config['max_size']             = 2048; // 2MB
		    // $config['max_width']            = 1024;
		    // $config['max_height']           = 768;

		    $this->load->library('upload', $config);

		     if ($this->upload->do_upload('nota')) {
        		$nama_file = $this->upload->data("file_name");
				$insert = array(
								'tgl_pembayaran' => $tgl_pembayaran,
								'kd_dana' => $kd_dana,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan,
								'status' => $status,
								'nota' => $nama_file,
								'kd_thn_ajaran' => $kd_thn_ajaran
				);

				$this->pembayaran_model->insertBesaran($insert);

				$insert2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'posisi' => 'Kredit',
								'jumlah' => $jumlah_pembayaran,
								'kd_kas' => $kd_dana.'-'.$this->laboratorium_lib->getIDBesaran(),
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s'),
								'nota' => $nama_file
				);

				$this->keuangan_model->insertKeuangan($insert2);

				$this->session->set_flashdata('success', 'Pembayaran Alat & Maintance berhasil diinput');
				redirect('backend/maintance');
			} else {
				$insert = array(
								'tgl_pembayaran' => $tgl_pembayaran,
								'kd_dana' => $kd_dana,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan,
								'status' => $status,
								'kd_thn_ajaran' => $kd_thn_ajaran
				);

				$this->pembayaran_model->insertBesaran($insert);

				$insert2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'posisi' => 'Kredit',
								'jumlah' => $jumlah_pembayaran,
								'kd_kas' => $kd_dana.'-'.$this->laboratorium_lib->getIDBesaran(),
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s')
				);

				$this->keuangan_model->insertKeuangan($insert2);
				$this->session->set_flashdata('error', 'Pembayaran Alat & Maintance berhasil diinput tanpa Nota');
				redirect('backend/maintance');
			}
		}else{
			$data = array();
			$data['tipe'] = 'b12';
			$data['ta'] = $this->laboratorium_lib->list_ta();
			$this->load->view('header');
			$this->load->view('maintance_add', $data);
			$this->load->view('footer');
		}
	}

	public function maintance_ubah($id)
	{
		$data = array();
		$data['tipe'] = 'b12';
		$data['ta'] = $this->laboratorium_lib->list_ta();
		$data['data'] = $this->pembayaran_model->selectBesaran($id);
		$this->load->view('header');
		$this->load->view('maintance_update', $data);
		$this->load->view('footer');
	}

	public function maintance_update($id)
	{
		$kd_thn_ajaran = $this->input->post('kd_thn_ajaran');
		$kd_dana = $this->input->post('kd_dana');
		$jumlah_pembayaran = $this->input->post('jumlah_pembayaran');
		$tgl_pembayaran = $this->input->post('tgl_pembayaran');
		$keterangan = $this->input->post('keterangan');
		$nota_lama = $this->input->post('nota_lama');

		$this->form_validation->set_rules('kd_thn_ajaran','Tahun Ajaran','required', array('required' => '%s tidak  boleh kosong'));
		$this->form_validation->set_rules('tgl_pembayaran','Tanggal','required', array('required' => '%s tidak  boleh kosong'));

		$this->form_validation->set_rules('jumlah_pembayaran','Jumlah Pembayaran','required', array('required' => '%s tidak  boleh kosong'));

		if($this->form_validation->run() == true){
			if($nota_lama != '' && $_FILES['nota']['name'] != ''){
				unlink('./nota/'.$kd_dana.'/'.$nota_lama);
			}
			$config['upload_path']          = './nota/'.$kd_dana;
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['file_name']            = $kd_dana.'_'.date('YmdHis');
		    $config['overwrite']			= true;
		    $config['max_size']             = 2048; // 2MB
		    // $config['max_width']            = 1024;
		    // $config['max_height']           = 768;

		    $this->load->library('upload', $config);

		     if ($this->upload->do_upload('nota')) {
        		$nama_file = $this->upload->data("file_name");

				$update = array(
								'tgl_pembayaran' => $tgl_pembayaran,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan,
								'nota' => $nama_file,
								'kd_thn_ajaran' => $kd_thn_ajaran
				);

				$this->pembayaran_model->updateBesaran($id,$update);

				$update2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'jumlah' => $jumlah_pembayaran,
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s'),
								'nota' => $nama_file
				);

				$this->keuangan_model->updateKeuangan2($kd_dana.'-'.$id, $update2);

				$this->session->set_flashdata('success', 'Pembayaran Alat & Maintance berhasil diupdate');
				redirect('backend/maintance');
			} else {
				$update = array(
								'tgl_pembayaran' => $tgl_pembayaran,
								'jumlah_pembayaran' => $jumlah_pembayaran,
								'keterangan' => $keterangan,
								'nota' => $nama_file,
								'kd_thn_ajaran' => $kd_thn_ajaran
				);

				$this->pembayaran_model->updateBesaran($id,$update);

				$update2 = array(
								'tgl' => $tgl_pembayaran,
								'kd_thn_ajaran' => $kd_thn_ajaran,
								'keterangan' => $keterangan == '' ? $this->laboratorium_lib->getKeteranganDana($kd_dana) : $this->laboratorium_lib->getKeteranganDana($kd_dana).' ('.$keterangan.')',
								'jumlah' => $jumlah_pembayaran,
								'kd_akun_updated' => $this->session->userdata('uid'),
								'updated' => date('Y-m-d H:i:s'),
								'nota' => $nama_file
				);

				$this->keuangan_model->updateKeuangan2($kd_dana.'-'.$id, $update2);
				$this->session->set_flashdata('error', 'Pembayaran Alat & Maintance berhasil diupdate tanpa Nota');
				redirect('backend/maintance');
			}
		}else{
			$data = array();
			$data['ta'] = $this->laboratorium_lib->list_ta();
			$data['data'] = $this->pembayaran_model->selectBesaran($id);
			$data['tipe'] = 'b11';
			$this->load->view('header');
			$this->load->view('maintance_update', $data);
			$this->load->view('footer');
		}
	}

	public function maintance_delete($id){
		$data = $this->pembayaran_model->selectBesaran($id);
		$this->pembayaran_model->deleteBesaran($id);
		$this->keuangan_model->deleteKeuangan2($data->kd_dana.'-'.$id);
		if($this->laboratorium_lib->getNota2($data->kd_dana.'-'.$id) != ''){
			unlink('./nota/'.$data->kd_dana.'/'.$this->laboratorium_lib->getNota2($data->kd_dana.'-'.$id));
		}
		$this->session->set_flashdata('success', 'Pembayaran Alat & Maintance berhasil dihapus');
		redirect('backend/maintance');
	}

	public function validasi_laporan()
	{
		$data = array();
		$data['data'] = $this->keuangan_model->getValidasiKeuangan();
		$this->load->view('header');
		$this->load->view('validasi', $data);
		$this->load->view('footer');
	}

	public function validasi_proses($id)
	{
		$update = array(
						'validasi' => 'Y'
		);
		$this->keuangan_model->updateKeuangan($id,$update);
		$this->session->set_flashdata('success', 'Validasi Keuangan berhasil dilakukan');
		redirect('backend/validasi_laporan');
	}

	public function laporan_keuangan()
	{
		$data = array();
		$data['ta'] = $this->laboratorium_lib->list_ta();

		$ta=0;
		if(isset($_POST['cari'])){
			$ta = $_POST['ta'];
		  if($_POST['posisi'] != ''){
			$data['data'] = $this->keuangan_model->getKeuanganValidSearch($_POST['posisi'], $_POST['ta']);
		  } else {
			$data['data'] = $this->keuangan_model->getKeuanganValidSearch($_POST['posisi'], $_POST['ta']);
		  }
		} else {
		  $data['data'] = $this->keuangan_model->getKeuanganValid();	
		}


		$data['tahunajaran'] = "";
		$data['semester'] = "";
		foreach($data['ta'] as $struct) {
			if ($ta == $struct->kd_thn_ajaran) {
				$data['tahunajaran'] = $struct->thn_ajaran;
				$data['semester'] = $struct->semester;
				break;
			}
		}
	//	var_dump( $data['data'] );
		$this->load->view('header');
		$this->load->view('laporan_keuangan', $data);
		$this->load->view('footer');
	}

	public function laporan_asisten()
	{
		$data = array();
		$data['ta'] = $this->laboratorium_lib->list_ta();

		$ta=0;
		if(isset($_POST['cari'])){
			$ta=$_POST['ta'];
		  	$data['data'] = $this->pembayaran_model->getPembayaranAsistenSearch($_POST['ta']);
		} else {
		  $data['data'] = $this->pembayaran_model->getPembayaranAsisten();	
		}
		
		$data['tahunajaran'] = "";
		$data['semester'] = "";
		foreach($data['ta'] as $struct) {
			if ($ta == $struct->kd_thn_ajaran) {
				$data['tahunajaran'] = $struct->thn_ajaran;
				$data['semester'] = $struct->semester;
				break;
			}
		}
		
		$this->load->view('header');
		$this->load->view('laporan_asisten', $data);
		$this->load->view('footer');
	}

	public function laporan_penanggungjawab()
	{

		$data = array();
		$ta=0;
		$data['ta'] = $this->laboratorium_lib->list_ta();
		if(isset($_POST['cari'])){
			$ta = $_POST['ta'];
			$data['data'] = $this->pembayaran_model->getPembayaranPenanggungjawabSearch($ta);
		} else {
		  $data['data'] = $this->pembayaran_model->getPembayaranPenanggungjawab();	
		}


		
		$data['tahunajaran'] = "";
		$data['semester'] = "";
		foreach($data['ta'] as $struct) {
			if ($ta == $struct->kd_thn_ajaran) {
				$data['tahunajaran'] = $struct->thn_ajaran;
				$data['semester'] = $struct->semester;
				break;
			}
		}

		$this->load->view('header');
		$this->load->view('laporan_penanggungjawab', $data);
		$this->load->view('footer');
	}

	function matakuliah(){
		$ta = $this->input->post('id');
		$matakuliah = '<option value="">Pilih</pilih>';
		$this->db2->select('a.kd_mk, b.nama_mk');
		$this->db2->from('jadwal_praktikum a');
		$this->db2->join('mk_praktikum b', 'b.kd_mk=a.kd_mk');
		$this->db2->where('a.kd_thn_ajaran', $ta);
		$this->db2->group_by('a.kd_mk');
		$kab = $this->db2->get();
		foreach ($kab->result_array() as $data ){
			$matakuliah .= '<option value="'.$data['kd_mk'].'">'.$data['kd_mk'].' - '.$data['nama_mk'].'</option>';
		}
		echo $matakuliah;
	}

	function asisten(){
		$id = $this->input->post('id');
		$kabupaten = '<option value="">Pilih</pilih>';
		$this->db2->select('a.*,b.nama_pengajar');
		$this->db2->from('jadwal_praktikum a');
		$this->db2->join('pengajar b', 'b.kd_pengajar=a.kd_pengajar', 'left');
		$this->db2->where('a.kd_mk', $id);
		$this->db2->group_by('a.kd_pengajar');
		$kab = $this->db2->get();
		foreach ($kab->result_array() as $data ){
			$kabupaten .= '<option value="'.$data['kd_pengajar'].'">'.$data['nama_pengajar'].'</option>';
		}
		echo $kabupaten;
	}

	

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}
}