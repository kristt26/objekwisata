<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marking_model extends CI_Model {
    public function select()
    {
        $result = $this->db->query("SELECT
            *
        FROM
            `wisata`
            LEFT JOIN `marking` ON `marking`.`idwisata` = `wisata`.`idwisata`
        Where status not in (true,false)")->result();
        return $result;
    }
    public function update($data)
    {
        $item=[
            'status'=>$data['status']
        ];
        $this->db->where('idmarking', $data['idmarking']);
        $result = $this->db->update('marking', $item);
        return $result;
    }
    public function delete($idwisata)
    {
        $this->db->trans_begin();
        $this->db->where('idwisata', $idwisata);
        $this->db->delete('marking');
        $this->db->where('idwisata', $idwisata);
        $this->db->delete('wisata');
        if($this->db->trans_status()== true){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
        $result = $this->db->update('marking', $item);
        return $result;
    }
}

/* End of file ModelName.php */

