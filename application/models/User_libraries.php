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

    public function userlibraryjoin($user_id,$buku_ids)
    {
        $this->db->select('b.judul_buku');
        $this->db->from('user_libraries ul');
        $this->db->join('Buku b', 'ul.buku_id = b.id');
        $this->db->where('ul.user_id', $user_id);
        $this->db->where_in('ul.buku_id', $buku_ids);
        $result = $this->db->get()->result_array();
        return $result;
        
    }
}
