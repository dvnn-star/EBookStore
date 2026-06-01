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
        $this->db->order_by("FIELD(transactions.status, 'success', 'pending', 'failed')", '', FALSE);


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

        $this->db->order_by('transactions.tanggal', 'DESC');
        $this->db->order_by("FIELD(transactions.status, 'success', 'pending', 'failed')", '', FALSE);
        $query = $this->db->get_where('transactions', ['user_id' => $userid], $limit, $start)->result();
        return $query;
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



        if ($status === 'success') {
            $items = $this->db->get_where('transactions_detail', ['transactions_id' => $transaksi->id])->result();

            foreach ($items as $item) {
                $this->db->where('user_id', $transaksi->user_id);
                $this->db->where('buku_id', $item->buku_id);
                $sudah_punya = $this->db->get('user_libraries')->num_rows();

                if ($sudah_punya > 0) {
                    $this->db->trans_rollback();
                    return false;
                }
            }

            foreach ($items as $item) {
                $this->db->set('total_terjual', 'total_terjual + ' . (int)$item->qty, FALSE);
                $this->db->where('id', $item->buku_id);
                $this->db->update('Buku');

                $this->db->insert('user_libraries', [
                    'user_id'    => $transaksi->user_id,
                    'buku_id'    => $item->buku_id,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $this->db->update('transactions', ['status' => $status], ['kode_transaksi' => $kode_transaksi]);
        $this->db->trans_complete();


        return $this->db->trans_status();
    }
    public function HasPendingBook($user_id, $buku_id)
    {
        return $this->db
            ->select('td.buku_id')
            ->from('transactions_detail td')
            ->join('transactions t', 't.id = td.transactions_id', 'INNER')
            ->where('t.user_id', $user_id)
            ->where('t.status', 'pending')
            ->where_in('td.buku_id', $buku_id)
            ->get()
            ->result();
    }
}
