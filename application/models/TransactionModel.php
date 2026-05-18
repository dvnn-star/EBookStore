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
        $this->db->join('users', 'users.id = transactions.user_id', 'left');


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
    public function GetAllTransactionAndJoin()
    {
        $this->db->select('transactions.*,users.name');
        $this->db->from('transactions');
        $this->db->join('users', 'users.id = transactions.user_id', 'left');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function Get3TableJoin($kode_transaksi)
    {
        $this->db->select('
        transactions.*,
        users.name ,
        transactions_detail.qty,
        transactions_detail.harga_beli,
        Buku.judul_buku,
        Buku.penulis,
        Buku.gambar,
        Buku.id 
    ');

        $this->db->from('transactions');

        $this->db->join('users', 'users.id = transactions.user_id', 'INNER');


        $this->db->join('transactions_detail', 'transactions_detail.transactions_id = transactions.id', 'INNER');

        $this->db->join('Buku', 'Buku.id = transactions_detail.buku_id', 'INNER');


        $this->db->where('transactions.kode_transaksi', $kode_transaksi);


        return $this->db->get()->result();
    }

    public function ChangeStatus($kode_transaksi, $status)
    {
        $this->db->trans_start();
        $transaksi = $this->db->get_where('transactions', ['kode_transaksi' => $kode_transaksi])->row();


        if (!$transaksi || $transaksi->status !== 'pending') {
            return false;
        }

        $this->db->update('transactions', ['status' => $status], ['kode_transaksi' => $kode_transaksi]);

   
        if ($status === 'success') {
            // Ambil semua item buku yang ada di dalam transaksi ini
            $items = $this->db->get_where('transactions_detail', ['transactions_id' => $transaksi->id])->result();

            foreach ($items as $item) {
                // Gunakan $this->db->set() dengan parameter ketiga FALSE agar query menjadi: total_terjual = total_terjual + qty
                $this->db->set('total_terjual', 'total_terjual + ' . (int)$item->qty, FALSE);
                $this->db->where('id', $item->buku_id);
                $this->db->update('Buku');
            }
        }

        $this->db->trans_complete();

    
        return $this->db->trans_status();
    }
}
