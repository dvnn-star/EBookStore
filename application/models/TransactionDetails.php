<?php 
class TransactionDetails extends CI_Model
{
    public function GetDetailsById($id)
    {
        $query = $this->db->get_where('transactions_detail',['transactions_id' => $id]);
        return $query->result();
    }
    
}