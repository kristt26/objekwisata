<?php
class Kategori_model extends CI_Model
{
    public function select()
    {
        $result = $this->db->get('kategori_wisata');
        return $result->result_array();        
    } 

    public function insert($data)
    {
        $result = $this->db->insert('kategori_wisata', $data);
        if($result){
            return true;
        }else{
            return false;
        }
                
    }  
    public function update($data)
    {
        $this->db->where('idkategori_wisata', $data['idkategori']);
        $dataa = [
            'nama' => $data['nama']
        ];
        $result = $this->db->update('kategori_wisata', $dataa);
        if($result){
            return true;
        }else{
            return false;
        }
                
    }
    public function delete($data)
    {
        $this->db->where('idkategori_wisata', $data['id']);
        $result = $this->db->delete('kategori_wisata');
        if($result){
            return true;
        }else{
            return false;
        }
                
    }    
}
