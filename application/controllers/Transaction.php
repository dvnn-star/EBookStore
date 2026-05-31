<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model('TransactionModel');
    }
    public function index()
    {
        $userId = $this->session->userdata('user_id');
        $config['base_url']   = base_url('transaction');
        $config['total_rows'] = $this->TransactionModel->count_transaction_user($userId);
        $config['per_page']   = 5;
        $config['uri_segment'] = 2; // Sesuaikan dengan posisi angka di URL
        $config['reuse_query_string'] = TRUE;

        $config['full_tag_open']    = '<nav class="flex items-center space-x-2">';
        $config['full_tag_close']   = '</nav>';
        $config['num_tag_open']     = '<span class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50">';
        $config['num_tag_close']    = '</span>';
        $config['cur_tag_open']     = '<span class="px-4 py-2 text-sm font-bold text-white bg-indigo-600 border border-indigo-600 rounded-lg shadow-sm">';
        $config['cur_tag_close']    = '</span>';
        $config['next_link']        = 'Next &rarr;';
        $config['prev_link']        = '&larr; Prev';


        $this->pagination->initialize($config);


        // Ambil offset dari URL (default 0)
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $data['transaction'] = $this->TransactionModel->GetPaginationTransactionsUser($config['per_page'], $page, $userId);
        $data['pagination'] = $this->pagination->create_links();
        $data['start']      = $page;
        $data['total']      = $config['total_rows'];



        $this->load->view('pages/transactionPage', $data);
    }
    public function create()

    {
        $this->load->model('User_libraries');
        $user_id = $this->session->userdata('user_id');
        $items = json_decode($this->input->post('cart_data'), true);

        if (!$items || !is_array($items)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'data tidak valid'
                ]));
        }

        // ambil semua id
        $buku_ids = array_column($items, 'buku_id');

        $already_owned = $this->User_libraries->userlibraryjoin($user_id, $buku_ids);
        if (!empty($already_owned)) {
            $judul_terbeli = array_column($already_owned, 'judul_buku');
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Gagal! Buku berikut sudah Anda miliki: ' . implode(', ', $judul_terbeli)
                ]));
        }
        $pending = $this->TransactionModel->HasPendingBook($user_id, $buku_ids);

        if (!empty($pending)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Masih ada buku yang pending',
                    'redirect_url' => base_url('EBookStore/transaction/')
                ]));
        }
        // ambil semua buku sekaligus
        $books = $this->db->where_in('id', $buku_ids)->get('Buku')->result();

        // mapping
        $bookMap = [];
        foreach ($books as $b) {
            $bookMap[$b->id] = $b;
        }

        $total = 0;
        $details = [];

        foreach ($items as $item) {
            if (!isset($bookMap[$item['buku_id']])) {
                return error('Buku tidak ditemukan');
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
    public function show($slug)
    {
        $id = $this->TransactionModel->GetId($slug);
        $data['details'] = $this->db->select('
        transactions_detail.qty,
        transactions_detail.harga_beli,
        Buku.judul_buku,
        Buku.penulis,
        Buku.harga')
            ->from('transactions_detail')
            ->join('Buku', 'Buku.id = transactions_detail.buku_id', 'inner')->where('transactions_detail.transactions_id', $id->id)->get()->result();
        $data['kode_transaksi'] = $slug;
        $this->load->view('pages/transactionshow', $data);
    }
    public function updatestatus()
    {
        $this->load->model('TransactionModel');
        $kode_transaksi = $this->input->post('kode_transaksi');
        $proses = $this->TransactionModel->ChangeStatus($kode_transaksi, 'failed');

        if ($proses) {
            return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'success',
                    'message' => 'berhasil diubah'
                ]));
        } else {
            return $this->output
                ->set_status_header(422)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'gagal update'
                ]));
        }
    }
}
