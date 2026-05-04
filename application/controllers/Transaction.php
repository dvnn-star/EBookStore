<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();


        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }
    public function index()
    {

        $user_id = $this->session->userdata('user_id');
        $result['data'] = $this->TransactionModel->getAllDataByUser($user_id);

        $this->load->view('pages/transactionPage', $result);
    }
    public function create()

    {
        if ($this->input->method() !== 'post') {
            show_error('Method does not match lol', 405);
        }
        if (!$items || !is_array($items)) {
            show_error('Invalid input');
        }
        $user_id = $this->session->userdata('user_id');
        $items = $this->input->post('items');
        $total = 0;
        $details = [];

        foreach ($items as $item) {
            $book = $this->db->get_where('Buku', [
                'id' => $item['buku_id']
            ])->row();
            if (!$book) {
                print_r('error bang');
                return show_error('bukunya kaga ada', 404);
            }
            $subtotal = $book->harga * $item['qty'];
            $total += $subtotal;
            $details[] =  [
                'buku_id' => $book->id,
                'qty' => $item['qty'],
                'harga_beli' => $book->harga
            ];
        }

        try {
            // menggunakan transacition
            $this->db->trans_start();
            $this->db->insert('transactions', [
                'user_id' => $user_id,
                'kode_transaksi' => $this->TransactionModel->generate_kode_transaksi(),
                'total_harga' => $total,
                'tanggal' => date("Y/m/d")
            ]);
            // ambil data id yang telah diinsert
            $transaction_id = $this->db->insert_id();
            foreach ($details as $item) {


                $this->db->insert('transactions_details', [
                    'transactions_id' => $transaction_id,
                    'buku_id'  => $item['buku_id'],
                    'qty' => $item['qty'],
                    'harga_beli' => $item['harga_beli']
                ]);
            }
            $this->db->trans_complete();
            // ngecek hasil transaction
            if ($this->db->trans_status() === FALSE) {
                show_error('Transaction failed');
            }
            redirect('payments/index/' . $transaction_id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
