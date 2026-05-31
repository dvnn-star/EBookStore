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
    public function getById($slug)
    {
        return $this->db->get_where('Buku', ['id' => $slug])->row();
    }
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('Buku', $data);
    }
    public function Delete($id)
    {
        $this->db->delete('Buku', ['id' => $id]);
    }
    public function insert_buku($data)
    {
        return $this->db->insert('Buku', $data);
    }
    public function CheckJudulDiDatabase($judul)
    {
        $data = $this->db
            ->select('id')
            ->where('judul_buku', $judul)
            ->limit(1)
            ->get('Buku')
            ->row();
        return $data;
    }
    public function GetHighRating()
    {
        $this->db->select('*');
        $this->db->from('Buku');
        $this->db->where('rating =', '5');
        $query = $this->db->get();
        return $query->result();
    }
    public function GetTotalSales()
    {
        $this->db->from('Buku');
        $this->db->select('*');
        $this->db->order_by('total_terjual','DESC');
        $this->db->limit(4);
        return $this->db->get()->result_array();

    }
    
}
