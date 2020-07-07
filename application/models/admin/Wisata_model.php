<?php
class Wisata_model extends CI_Model
{
    public function select()
    {
        $result = $this->db->get('kategori_wisata');
        $datawisata['wisata'] = array(); 
        foreach ($result->result_array() as $key => $itemkategori){
            $item = [
                'kategori' => $itemkategori['nama'],
                'idkategori_wisata' => $itemkategori['idkategori_wisata'],
                'wisata' =>array()
            ];
            $this->db->where('idkategori_wisata', $itemkategori['idkategori_wisata']);
            $resultwisata = $this->db->get('wisata');
            $item['wisata'] = $resultwisata->result_array();
            array_push($datawisata['wisata'], $item);
        }
        return $datawisata['wisata'];      
    } 

    public function selectbyid($id)
    {
        $resultwisata = $this->db->get_where('wisata', array('idkategori_wisata' => $id['id']));
        return $resultwisata->result();   
    }

    public function insert($data)
    {
        $result = $this->db->insert('wisata', $data);
        if($result){
            return true;
        }else{
            return false;
        }
    }  

    public function update($data)
    {
        $this->db->where('idwisata', $data['idwisata']);
        $dataa = [
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'keterangan' => $data['keterangan'],
            'long' => $data['long'],
            'lat' => $data['lat'],
        ];
        $result = $this->db->update('wisata', $dataa);
        if($result){
            return true;
        }else{
            return false;
        }
                
    }
    public function delete($data)
    {
        $this->db->where('idwisata', $data['id']);
        $result = $this->db->delete('wisata');
        if($result){
            return true;
        }else{
            return false;
        }
                
    }    
}
