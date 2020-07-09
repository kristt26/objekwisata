<?php

class Google_login_model extends CI_Model
{
    public function Is_already_register($id)
    {
        $this->db->where('oauth_uid', $id);
        $result = $this->db->get('users');
        if($result->num_rows()>0){
            return true;
        }else{
            return false;
        }
        # code...
    }    

    public function Update_user_data($data, $id)
    {
        $this->db->where('oauth_uid', $id);
        $this->db->update('users', $data);
    }

    public function Insert_user_data($data)
    {
        $this->db->insert('users', $data);
    }
}
