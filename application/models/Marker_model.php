<?php

class Marker_model extends CI_Model {
    public function insert($data)
    {
        $result=$this->db->insert('marking', $data);
        return $result;
    }
    public function select($id)
    {
        $result = $this->db->get_where('marking', array('idwisata'=>$id));
        return $result->result();
    }
}

/* End of file ModelName.php */
