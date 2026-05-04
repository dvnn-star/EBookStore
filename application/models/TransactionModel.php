<?php
class TransactionModel extends CI_Model
{

    public function getAllDataByUser($user_id)
    {
        return $this->db->get_where('transactions', ['user_id' => $user_id])->result();
    }
    public function generate_kode_transaksi()
    {
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        return "TRX-$date-$random";
    }
}
