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
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Methode tidak cocok'
                ]));
        }
        $items = json_decode($this->input->post('cart_data'), true);
        $user_id = $this->session->userdata('user_id');
        if (!$items || !is_array($items)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Buku tidak ditemukan'
                ]));
        }

        $total = 0;
        $details = [];

        foreach ($items as $item) {
            $book = $this->db->get_where('Buku', [
                'id' => $item['buku_id']
            ])->row();
            if (!$book) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status' => 'error',
                        'message' => 'Buku tidak ditemukan'
                    ]));
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
            // menggunakan transaction
            $this->db->trans_start();
            $KodeTransaksi = $this->TransactionModel->generate_kode_transaksi();
            $this->db->insert('transactions', [
                'user_id' => $user_id,
                'kode_transaksi' => $KodeTransaksi,
                'total_bayar' => $total,
                'tanggal' => date("Y/m/d")
            ]);
            // ambil data id yang telah diinsert
            $transaction_id = $this->db->insert_id();
            foreach ($details as $item) {


                $this->db->insert('transactions_detail', [
                    'transactions_id' => $transaction_id,
                    'buku_id'  => $item['buku_id'],
                    'qty' => $item['qty'],
                    'harga_beli' => $item['harga_beli']
                ]);
            }
            $this->db->trans_complete();
            // ngecek hasil transaction
            if ($this->db->trans_status() === FALSE) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status' => 'error',
                        'message' => 'erorr pada saat melakukan transaksi'
                    ]));
            }
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'success',
                'redirect_url' => base_url('payments/' . $KodeTransaksi)
            ]));
        } catch (\Throwable $th) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => $th->getMessage()
                ]));
        }
    }
}
