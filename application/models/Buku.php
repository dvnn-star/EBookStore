<?php
class Buku extends CI_Model
{
    public function getALL()
    {
        return $this->db->get('Buku')->result();
    }
    public function GetPaginationBooks($limit, $start)
    {
        return $this->db->get('Buku', $limit, $start)->result();
    }
    public function count_all_books()
    {
        return $this->db->count_all('Buku');
    }
}
