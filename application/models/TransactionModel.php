<?php
class TransactionModel extends CI_Model
{

    public function getAllDataByUser($user_id)
    {
        return $this->db->get_where('transactions', ['user_id' => $user_id])->result();
    }
    public function GetTransactionRecord($kode)
    {
        return $this->db->get_where('transactions', ['kode_transaksi' => $kode])->row();
    }
    public function generate_kode_transaksi()
    {
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        return "TRX-$date-$random";
    }
    public function GetPaginationTransactions($limit, $start)
    {

        $this->db->select('transactions.*, users.name as full_name, users.email');

        $this->db->from('transactions');
        +$this->db->join('users', 'users.id = transactions.user_id', 'left');


        $this->db->order_by('transactions.tanggal', 'DESC');

        $this->db->limit($limit, $start);

        return $this->db->get()->result();
    }
    public function count_all_transactions()
    {
        return $this->db->count_all('transactions');
    }
    public function count_transaction_user($id)
    {
        $this->db->where('user_id', $id);
        $this->db->from('transactions');
        $count = $this->db->count_all_results();
        return $count;
    }
    public function GetPaginationTransactionsUser($limit, $start, $userid)
    {
        return $this->db->get_where('transactions', ['user_id' => $userid], $limit, $start)->result();
    }
    public function GetId($kode)
    {
        $this->db->select('id');
        $this->db->from('transactions');
        $this->db->where('kode_transaksi', $kode);
        return $this->db->get()->row();
    }
}
