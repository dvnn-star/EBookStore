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
        $config['cur_tag_open']     = '<span class="px-4 py-2 text-sm font-bold text-white bg-[#005B52] border border-[#005B52] rounded-lg shadow-sm">';
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
        $this->load->library('transactionservices');
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
        $is_pending = $this->transactionservices->checkpendingbook($user_id, $buku_ids);
        if ($is_pending == true) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400) // Berikan status 400 karena ini bad request/error logika
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Masih ada buku yang pending yang ada di riwayat transaksi',
                    'redirect_url' => base_url('EBookStore/transaction/')
                ]));
        }    
        try {
            // Panggil service dan tangkap hasilnya
            $KodeTransaksi = $this->transactionservices->create($user_id, $items);

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'success',
                    'redirect_url' => base_url('payments/' . $KodeTransaksi)
                ]));
        } catch (\Throwable $th) {
            return $this->output
                ->set_status_header(500)
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
        $status = $this->input->post('status');
        $data['details'] = $this->db->select('
        transactions_detail.qty,
        transactions_detail.harga_beli,
        Buku.judul_buku,
        Buku.penulis,
        Buku.harga')
            ->from('transactions_detail')
            ->join('Buku', 'Buku.id = transactions_detail.buku_id', 'inner')->where('transactions_detail.transactions_id', $id->id)->get()->result();
        $data['kode_transaksi'] = $slug;
        $data['status'] = $status;
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
