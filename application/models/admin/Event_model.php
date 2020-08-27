<?php
class Event_model extends CI_Model
{
    function select()
    {
        $data['wisata']=array();
        $wisata = $this->db->get('wisata');
        foreach ($wisata->result_array() as $key => $itemwisata) {
            $itemwisata['event']= array();
            $event = $this->db->get_where('event', array('idwisata'=>$itemwisata['idwisata']));
            if($event->num_rows()>0){
                $itemwisata['event'] =  $event->result();
            }
            array_push($data['wisata'], $itemwisata);
        }
        return $data['wisata'];
    } 
    function eventonly()
    {
        $data['event']=array();
        $event = $this->db->query("SELECT
            *
        FROM
            `event`
        ORDER By tgl_posting DESC");
        return $event->result();
    }
    public function selectone($id)
    {
        $resultevent = $this->db->get_where('event', array('idevent' => $id))->result()[0];
        return $resultevent;   
    }
    public function selectevent()
    {
        return $this->db->query("SELECT
            `event`.*,
            `wisata`.`nama` AS `namawisata`
        FROM
            `event`
            LEFT JOIN `wisata` ON `wisata`.`idwisata` = `event`.`idwisata`")->result();
    }
    function insert($data)
    {
        if (($a = $this->do_upload()) != false) {
            $data['foto'] = $a['file_name'];
            $text = strip_tags($data['isi']);
            $data['stringtext'] = substr($text,0,120);
            $result = $this->db->insert('event', $data);
            return $result;
        }else{
            return false;
        }
        
    } 
    function update($data)
    {
        if (($a = $this->do_upload()) != false) {
            $item = [
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'isi' => $data['isi'],
                'tgl_mulai' => $data['tgl_mulai'],
                'tgl_selesai' => $data['tgl_selesai'],
                'tgl_posting' => $data['tgl_posting'],
                'stringtext' => $data['isi'],
                'foto' => $a['file_name']
            ];
            $this->db->where('idevent', $data['idevent']);
            $result =  $this->db->update('event', $item);
            return $result;
        }else{
            $item = [
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'isi' => $data['isi'],
                'tgl_mulai' => $data['tgl_mulai'],
                'tgl_selesai' => $data['tgl_selesai'],
                'tgl_posting' => $data['tgl_posting'],
                'stringtext' => $data['isi'],
            ];
            $this->db->where('idevent', $data['idevent']);
            $result =  $this->db->update('event', $item);
            return $result;
            return $result;
        }
        

    } 
    function delete($id)
    {
        $this->db->where('idevent', $id);
        $result = $this->db->delete('event');
        if($result){
            return true;
        }else{
            return false;
        }
    }    
    public function do_upload()
    {
        $config['upload_path'] = './assets/img/event/';
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
