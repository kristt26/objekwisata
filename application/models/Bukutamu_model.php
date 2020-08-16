<?php

class Bukutamu_model extends CI_Model
{
    public function insert($data)
    {
        if($this->db->insert('bukutamu', $data)){
            $data['idbukutamu'] = $this->db->insert_id();
            return $data;
        }
    } 
    public function select()
    {
        return $this->db->get('bukutamu')->result();
    }
}
