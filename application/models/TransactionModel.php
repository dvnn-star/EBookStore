<?php
class TransactionModel extends CI_Model{

    public function getAllDataByUser($user_id)
    {
        return $this->db->get_where('transactions',['user_id' => $user_id])->result();
    }
}