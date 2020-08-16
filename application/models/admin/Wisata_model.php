<?php
class Wisata_model extends CI_Model
{
    private $db2 = null;
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('pemasukan_model');
        $this->db2 = $this->load->database('db2', true);
    }

    public function select()
    {
        $result = $this->db->get('kategori_wisata');
        $datawisata['wisata'] = array();
        foreach ($result->result() as $key => $itemkategori) {
            $item = [
                'kategori' => $itemkategori->nama,
                'idkategori_wisata' => $itemkategori->idkategori_wisata,
                'icon' => $itemkategori->icon,
                'wisata' => array(),
            ];
            $resultwisata = $this->db->query("SELECT
                `wisata`.*,
                `marking`.`long`,
                `marking`.`lat`,
                `marking`.`created`,
                `marking`.`idmarking`,
                `marking`.`modifier`,
                `marking`.`iduser`,
                `marking`.`status`,
                `admin`.`nama` AS `namaadmin`,
                `member`.`nama` AS `namamember`
            FROM
                `wisata`
                LEFT JOIN `marking` ON `marking`.`idwisata` = `wisata`.`idwisata`
                LEFT JOIN `user` ON `user`.`iduser` = `marking`.`iduser`
                LEFT JOIN `member` ON `member`.`iduser` = `user`.`iduser`
                LEFT JOIN `admin` ON `admin`.`iduser` = `user`.`iduser`
            WHERE wisata.idkategori_wisata = '$itemkategori->idkategori_wisata' AND marking.status='true'");
            $item['wisata'] = $resultwisata->result();
            array_push($datawisata['wisata'], $item);
        }
        return $datawisata['wisata'];
    }

    public function selecthome()
    {
        $resultwisata = $this->db->query("SELECT
                `wisata`.*,
                `marking`.`long`,
                `marking`.`lat`,
                `marking`.`created`,
                `marking`.`idmarking`,
                `marking`.`modifier`,
                `marking`.`iduser`,
                `marking`.`status`,
                `admin`.`nama` AS `namaadmin`,
                `member`.`nama` AS `namamember`
            FROM
                `wisata`
                LEFT JOIN `marking` ON `marking`.`idwisata` = `wisata`.`idwisata`
                LEFT JOIN `user` ON `user`.`iduser` = `marking`.`iduser`
                LEFT JOIN `member` ON `member`.`iduser` = `user`.`iduser`
                LEFT JOIN `admin` ON `admin`.`iduser` = `user`.`iduser`
            WHERE marking.status='true'");
            return $resultwisata->result();
    }

    public function selectfoto($idwisata)
    {
        $result = $this->db->get_where('kategori_wisata', ['idwisata' => $idwisata])->row();
        return $result;
    }

    public function testing()
    {
        $query = $this->db2->get('jembatan'); //mengambil semua data jembatan
        return $query;
    }

    public function testing2()
    {
        $query = $this->db2->get('koordinatjembatan'); //mengambil semua data koordinat jembatan
        return $query;
    }

    public function selectbyid($id)
    {
        $resultwisata = $this->db->get_where('wisata', array('idkategori_wisata' => $id['id']));
        return $resultwisata->result();
    }

    public function wisataonly()
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
        $resultwisata = $this->db->query("SELECT
            `wisata`.*,
            `marking`.`long`,
            `marking`.`lat`,
            `marking`.`created`,
            `marking`.`idmarking`,
            `marking`.`modifier`,
            `marking`.`iduser`,
            `marking`.`status`,
            `admin`.`nama` AS `namaadmin`,
            `member`.`nama` AS `namamember`,
            `kategori_wisata`.`icon`
        FROM
            `wisata`
            LEFT JOIN `marking` ON `marking`.`idwisata` = `wisata`.`idwisata`
            LEFT JOIN `user` ON `user`.`iduser` = `marking`.`iduser`
            LEFT JOIN `member` ON `member`.`iduser` = `user`.`iduser`
            LEFT JOIN `admin` ON `admin`.`iduser` = `user`.`iduser`
            LEFT JOIN `kategori_wisata` ON `wisata`.`idkategori_wisata` =
            `kategori_wisata`.`idkategori_wisata`
        WHERE
            `wisata`.`idwisata` = '$id' AND
            `marking`.`status` = 'true'")->result();
        return $resultwisata;
    }

    public function selectwisata()
    {
        $user = $this->session->userdata('user_data');
        $string;
        if($user!=null){
            $string="AND (user.iduser='$user->iduser' OR user.jenis='admin')";
        }else{
            $string="";
        }

        
        $resultwisata = $this->db->query("SELECT
            `wisata`.*,
            `marking`.`long`,
            `marking`.`lat`,
            `marking`.`created`,
            `marking`.`idmarking`,
            `marking`.`modifier`,
            `marking`.`iduser`,
            `marking`.`status`,
            `admin`.`nama` AS `namaadmin`,
            `member`.`nama` AS `namamember`,
            `kategori_wisata`.`nama` AS `kategori`,
            `kategori_wisata`.`icon`
        FROM
            `wisata`
            LEFT JOIN `marking` ON `marking`.`idwisata` = `wisata`.`idwisata`
            LEFT JOIN `user` ON `user`.`iduser` = `marking`.`iduser`
            LEFT JOIN `member` ON `member`.`iduser` = `user`.`iduser`
            LEFT JOIN `admin` ON `admin`.`iduser` = `user`.`iduser`
            LEFT JOIN `kategori_wisata` ON `kategori_wisata`.`idkategori_wisata` =
            `wisata`.`idkategori_wisata`
            WHERE marking.status!='false' $string")->result();
        return $resultwisata;
    }

    public function insert($data)
    {
        $created = date('Y-m-d');
        $iduser = $this->session->userdata('user_data')->iduser;
        $this->db->trans_begin();
        $datawisata=[
            'nama'=>$data['nama'],
            'alamat'=>$data['alamat'],
            'keterangan'=>$data['keterangan'],
            'biayaparkir'=>$data['biayaparkir'],
            'biayapondok'=>$data['biayapondok'],
            'idkategori_wisata'=>$data['idkategori_wisata'],
            'foto'=>$data['foto']
        ];
        $result = $this->db->insert('wisata', $datawisata);
        $datakordinat = [
            'long'=>$data['long'],
            'lat'=>$data['lat'],
            'created'=>$created,
            'modifier'=>$data['modifier'],
            'idwisata'=>$this->db->insert_id(),
            'iduser'=>$iduser,
            'status'=>'true'
        ];
        $result = $this->db->insert('marking', $datakordinat);
        if ($this->db->trans_status()==true) {
            $this->db->trans_commit();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function insertmember($data)
    {
        $created = date('Y-m-d');
        $iduser = $this->session->userdata('user_data')->iduser;
        $this->db->trans_begin();
        $datawisata=[
            'nama'=>$data['nama'],
            'alamat'=>$data['alamat'],
            'keterangan'=>$data['keterangan'],
            'biayaparkir'=>$data['biayaparkir'],
            'biayapondok'=>$data['biayapondok'],
            'idkategori_wisata'=>$data['idkategori_wisata'],
            'foto'=>$data['foto']
        ];
        $result = $this->db->insert('wisata', $datawisata);
        $datakordinat = [
            'long'=>$data['long'],
            'lat'=>$data['lat'],
            'created'=>$created,
            'modifier'=>$data['modifier'],
            'idwisata'=>$this->db->insert_id(),
            'iduser'=>$iduser,
            'status'=>'false'
        ];
        $result = $this->db->insert('marking', $datakordinat);
        if ($this->db->trans_status()==true) {
            $this->db->trans_commit();
            return true;
        } else {
            $this->db->trans_rollback();
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
