<?php
class Transactionservices
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();


        $this->CI->load->model('TransactionModel');
        $this->CI->load->model('User_libraries');
    }

    public function create($user_id, $items)
    {
        $buku_ids = array_column($items, 'buku_id');

        $books = $this->CI->db->where_in('id', $buku_ids)->get('Buku')->result();

        // mapping
        $bookMap = [];
        foreach ($books as $b) {
            $bookMap[$b->id] = $b;
        }

        $total = 0;
        $details = [];

        foreach ($items as $item) {
            if (!isset($bookMap[$item['buku_id']])) {
                throw new Exception('Salah satu buku yang dipilih tidak ditemukan.');
            }


            $book = $bookMap[$item['buku_id']];
            $qty = max(1, (int)$item['qty']);

            $subtotal = $book->harga * $qty;
            $total += $subtotal;

            $details[] = [
                'buku_id' => $book->id,
                'qty' => $qty,
                'harga_beli' => $book->harga
            ];
        }

        // menggunakan transaction
        $this->CI->db->trans_start();
        $KodeTransaksi = $this->CI->TransactionModel->generate_kode_transaksi();
        $this->CI->db->insert('transactions', [
            'user_id' => $user_id,
            'kode_transaksi' => $KodeTransaksi,
            'total_bayar' => $total,
            'tanggal' => date("Y/m/d")
        ]);
        // ambil data id yang telah diinsert
        $transaction_id = $this->CI->db->insert_id();
        foreach ($details as $item) {


            $this->CI->db->insert('transactions_detail', [
                'transactions_id' => $transaction_id,
                'buku_id'  => $item['buku_id'],
                'qty' => $item['qty'],
                'harga_beli' => $item['harga_beli']
            ]);
        }
        $this->CI->db->trans_complete();
        // ngecek hasil transaction
        // Validasi status transaksi
        if ($this->CI->db->trans_status() === FALSE) {
            throw new Exception('Gagal mengeksekusi transaksi ke database.');
        }

        // JIKA SUKSES: Kembalikan kode transaksi ke Controller
        return $KodeTransaksi;
    }


    public function checkpendingbook($user_id, $buku_ids)
    {
        $pending = $this->CI->TransactionModel->HasPendingBook($user_id, $buku_ids);
        return !empty($pending);
    }
}
