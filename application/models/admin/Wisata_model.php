<?php
class Wisata_model extends CI_Model
{
    private $db2 = NULL;
	function __construct(){
		parent::__construct();
		// $this->load->model('pemasukan_model');
		$this->db2 = $this->load->database('db2', true);
    }
    
    public function select()
    {
        $result = $this->db->get('kategori_wisata');
        $datawisata['wisata'] = array();
        foreach ($result->result_array() as $key => $itemkategori) {
            $item = [
                'kategori' => $itemkategori['nama'],
                'idkategori_wisata' => $itemkategori['idkategori_wisata'],
                'wisata' => array(),
            ];
            $this->db->where('idkategori_wisata', $itemkategori['idkategori_wisata']);
            $resultwisata = $this->db->get('wisata');
            $item['wisata'] = $resultwisata->result_array();
            array_push($datawisata['wisata'], $item);
        }
        return $datawisata['wisata'];
    }

    function testing(){
        $query = $this->db2->get('jembatan');//mengambil semua data jembatan
		return $query;
    }

    function testing2()
    {
        $query = $this->db2->get('koordinatjembatan');//mengambil semua data koordinat jembatan
		return $query;
    }
    

    public function selectbyid($id)
    {
        $resultwisata = $this->db->get_where('wisata', array('idkategori_wisata' => $id['id']));
        return $resultwisata->result();
    }

    function wisataonly()
    {
        // $data['wisata']=array();
        $wisata = $this->db->query("SELECT
            *
        FROM
            `wisata`");
        return $wisata->result();
    }

    public function selectone($id)
    {
        $resultwisata = $this->db->get_where('wisata', array('idwisata' => $id));
        return $resultwisata->result();
    }

    public function insert($data)
    {
        if (($a = $this->do_upload()) != false) {
            $data['foto'] = $a['file_name'];
            $result = $this->db->insert('wisata', $data);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }

    }

    public function update($data)
    {
        if (($a = $this->do_upload()) != false) {
            $this->db->where('idwisata', $data['idwisata']);
            $dataa = [
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'keterangan' => $data['keterangan'],
                'long' => $data['long'],
                'lat' => $data['lat'],
                'foto' => $a['file_name'],
            ];
            $result = $this->db->update('wisata', $dataa);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function delete($data)
    {
        $this->db->where('idwisata', $data['id']);
        $result = $this->db->delete('wisata');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function do_upload()
    {
        $config['upload_path'] = './assets/img/wisata/foto/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = $this->mylib->randomchar();
        $config['max_size'] = 4096;
        $config['max_width'] = 2048;
        $config['max_height'] = 1028;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            return false;
        } else {
            $data = $this->upload->data();
            return $data;
        }
    }
}
