<?php
class TransactionModel extends CI_Model
{

    public function getAllDataByUser($user_id)
    {
        return $this->db->get_where('transactions', ['user_id' => $user_id])->result();
    }
    public function GetTransactionRecord($kode){
        return $this->db->get_where('transactions',['kode_transaksi' => $kode])->row();
    }
    public function generate_kode_transaksi()
    {
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        return "TRX-$date-$random";
    }
    public function GetPaginationTransactions($limit, $start)
    {
        // 1. SELECT spesifik: Ambil semua data transaksi, dan ambil nama/email dari tabel users
        // Saya alias-kan 'users.name' menjadi 'full_name' agar langsung cocok dengan frontend sebelumnya
        $this->db->select('transactions.*, users.name as full_name, users.email');
        
        $this->db->from('transactions');
        
        // 2. JOIN: Hubungkan foreign key transactions.user_id dengan primary key users.id
        $this->db->join('users', 'users.id = transactions.user_id', 'left');
        
        // 3. ORDER BY: Wajib ada untuk data transaksi agar yang terbaru muncul di atas
        $this->db->order_by('transactions.tanggal', 'DESC'); 
        
        // 4. LIMIT & OFFSET untuk Pagination
        $this->db->limit($limit, $start);
        
        return $this->db->get()->result();
    }
    public function count_all_transactions()
    {
        return $this->db->count_all('transactions');
    }
}
