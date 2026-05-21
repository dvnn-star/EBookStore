<?php 

class User_libraries extends CI_Model
{
    public function getdatabyuserid($user_id)
    {
        $this->db->select('user_libraries.*,Buku.judul_buku,Buku.penulis,Buku.gambar,Buku.deskripsi,Buku.kategori,Buku.penerbit');
        $this->db->from('user_libraries');
        $this->db->join('Buku','Buku.id = user_libraries.buku_id','INNER');
        $this->db->where('user_libraries.user_id',$user_id);
        $query = $this->db->get()->result();
        return $query;
    }

 
}
