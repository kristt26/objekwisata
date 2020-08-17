<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {
    public function select()
    {
        $result = $this->db->query("SELECT
            `kategori_wisata`.*,
            (select count(*) from wisata where `kategori_wisata`.`idkategori_wisata` = `wisata`.`idkategori_wisata`) as totalwisata
        FROM
            `kategori_wisata`
            INNER JOIN `wisata` ON `wisata`.`idkategori_wisata` =
            `kategori_wisata`.`idkategori_wisata`
        GROUP BY `kategori_wisata`.`idkategori_wisata`;")->result();
        return $result;
    }
}
