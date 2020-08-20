<?php

class User_model extends CI_Model
{
    public function get($data)
    {
        $result = $this->db->get_where('user', $data);
        if ($result->num_rows() > 0) {
            if ($result->row('jenis') == 'admin') {
                $resultuser = $this->db->query("SELECT
                    `admin`.*,
                    `user`.`jenis`
                FROM
                    `user`
                    LEFT JOIN `admin` ON `admin`.`iduser` = `user`.`iduser` WHERE user.username='$data[username]' AND user.password='$data[password]' AND user.status='Aktif'");
                return $resultuser->result();
            } else {
                if ($result->row('status') == 'Pending') {
                    return array('message' => 'Akun anda belum teraktivasi silahkan cek email anda untuk melakukan aktivasi');
                } else {
                    $resultuser = $this->db->query("SELECT
                        `member`.*,
                        `user`.`jenis`
                    FROM
                        `user`
                        LEFT JOIN `member` ON `member`.`iduser` = `user`.`iduser` WHERE user.username='$data[username]' AND user.password='$data[password]'");
                    return $resultuser->result();
                }
            }
        } else {
            return array('message' => 'username dan password tidak ditemukan');
        }
    }
    public function register($data)
    {
        if (isset($data['oauth_uid'])) {
            $user = [
                'username' => $data['email'],
                'password' => md5($data['oauth_uid']),
                'status' => 'Aktif',
            ];
            $member = [
                'nama' => $data['nama'],
                'jk' => $data['jk'],
                'email' => $data['email'],
                'status' => 'Aktif',
                'iduser' => '',
                'oauth_uid' => $data['oauth_uid'],
                'picture' => $data['picture'],
                'created' => $data['created'],
            ];

        } else {
            $user = [
                'username' => $data['username'],
                'password' => $data['password'],
                'status' => 'Pending',
            ];
            $member = [
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'jk' => $data['jk'],
                'email' => $data['email'],
                'status' => 'Pending',
                'iduser' => '',
            ];
        }
        $db_debug = $this->db->db_debug; //save setting

        $this->db->db_debug = false;
        $this->db->trans_begin();
        $this->db->insert('user', $user);
        // $this->db->error();
        $member['iduser'] = $this->db->insert_id();
        $this->db->insert('member', $member);
        $member['id'] = $this->db->insert_id();
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return $member;
        }

    }
    public function confirm($data)
    {
        $db_debug = $this->db->db_debug; //save setting
        $item = [
            'status' => 'Aktif',
        ];
        $this->db->db_debug = false;
        $this->db->trans_begin();
        $this->db->where('iduser', $data->iduser);
        $this->db->update('user', $item);
        $this->db->where('idmember', $data->id);
        $this->db->update('member', $item);
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
}
