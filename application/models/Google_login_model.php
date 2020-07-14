<?php

class Google_login_model extends CI_Model
{
    public function Is_already_register($id)
    {
        $this->db->where('oauth_uid', $id);
        $result = $this->db->get('member');
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
        # code...
    }

    public function get($id)
    {
        $resultuser = $this->db->query("SELECT
                        `member`.*,
                        `user`.`jenis`
                    FROM
                        `user`
                        LEFT JOIN `member` ON `member`.`iduser` = `user`.`iduser` WHERE member.oauth_uid='$id'");
        return $resultuser->result();
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
