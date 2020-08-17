<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function select()
    {
        $result = $this->db->get("member")->result();
        return $result;
    }   

    public function update($data)
    {
        $item = [
            "status"=> $data["status"]=="Aktif" ? "Pending": "Aktif"
        ];
        $this->db->trans_begin();
        $this->db->where("iduser", $data['iduser']);
        $this->db->update("member", $item);
        $this->db->where("iduser", $data['iduser']);
        $this->db->update("user", $item);
        if($this->db->trans_status()==true){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }

}

/* End of file ModelName.php */
