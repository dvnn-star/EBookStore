<?php

class User_libraries extends CI_Model
{
    public function getdatabyuserid($user_id)
    {
        $this->db->select('user_libraries.*,Buku.judul_buku,Buku.penulis,Buku.gambar,Buku.deskripsi,Buku.kategori,Buku.penerbit');
        $this->db->from('user_libraries');
        $this->db->join('Buku', 'Buku.id = user_libraries.buku_id', 'INNER');
        $this->db->where('user_libraries.user_id', $user_id);
        $query = $this->db->get()->result();
        return $query;
    }

    public function userlibraryjoin($user_id, $buku_ids)
    {
        $this->db->select('b.judul_buku');
        $this->db->from('user_libraries ul');
        $this->db->join('Buku b', 'ul.buku_id = b.id');
        $this->db->where('ul.user_id', $user_id);
        $this->db->where_in('ul.buku_id', $buku_ids);
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_katalog_with_status(int $user_id)
    {
        // Buku dijadikan shortcut b
        // user_libraries dijadikan ul
        // Mengambil semua kolom dari tabel Buku
        $this->db->select('b.*');

        // Flagging: Jika ul.id tidak null, artinya user sudah membeli buku tersebut
        $this->db->select('IF(ul.id IS NOT NULL, 1, 0) AS sudah_dimiliki');

        $this->db->from('Buku b');

        // CRITICAL JOIN: Evaluasi user_id dilakukan saat join, bukan di WHERE
        $this->db->join(
            'user_libraries ul',
            'b.id = ul.buku_id AND ul.user_id = ' . (int)$user_id,
            'left'
        );

        // Urutkan berdasarkan yang terbaru atau rating tertinggi jika diperlukan
        $this->db->order_by('b.total_terjual', 'ASC');

        return $this->db->get()->result_array();
    }
}
