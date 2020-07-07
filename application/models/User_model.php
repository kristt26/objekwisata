<?php

class User_model extends CI_Model
{
    public function register($data)
    {
        $user = [
            'username' => $data['username'],
            'password' => $data['password'],
            'status' => 'Pending'
        ]; 
        $member = [
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'jk' => $data['jk'],
            'email' => $data['email'],
            'status' => 'Pending',
            'iduser' => '',
            'token' => $data['token'],
        ]; 
        $db_debug = $this->db->db_debug; //save setting

        $this->db->db_debug = FALSE;
        $this->db->trans_begin();             
        $this->db->insert('user', $user);
        // $this->db->error();
        $member['iduser'] = $this->db->insert_id();
        $this->db->insert('member', $member);
        if ($this->db->trans_status() === FALSE)
        {
            
               $this->db->trans_rollback();
                
                return false;
        }
        else
        {
                $this->db->trans_commit();
                return true;
        }
    }
    
}
