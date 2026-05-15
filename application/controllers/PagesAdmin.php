<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PagesAdmin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('pagination');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        if (!$this->session->userdata('role') === 'admin') {
            show_error('You do not have permission to access this resource.', 403);
        }
        if (ENVIRONMENT !== 'development' && !is_cli()) {
            show_error('Akses tidak diizinkan.');
        }
    }
    // Untuk admin
    public function dashboard()
    {
        $config['base_url']   = base_url('dashboard');
        $config['total_rows'] = $this->TransactionModel->count_all_transactions();
        $config['per_page']   = 10;
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


        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $data = [];
        $data['all_transactions'] = $this->TransactionModel->GetPaginationTransactions($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        $data['start']      = $page;
        $data['total']      = $config['total_rows'];


        $data['data'] = $this->db->select('
        (SELECT COUNT(*) FROM users) as total_users,
        (SELECT COUNT(*) FROM Buku) as total_books,
        (SELECT COALESCE(SUM(total_bayar),0) FROM transactions WHERE status="success") as total_sales,
        ')->get()->row();

        $this->load->view('admin/dashboard', $data);
    }

    public function DaftarUser()
    {
        $config['base_url']   = base_url('admin/daftaruser');
        $config['total_rows'] = $this->User->count_all_users();
        $config['per_page']   = 10;
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

        $data['users'] = $this->User->GetPaginationUser($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        $data['start']      = $page;
        $data['total']      = $config['total_rows'];

        $this->load->view('admin/daftaruser', $data);
    }
    public function DaftarTransactions()
    {
        $config['base_url']   = base_url('admin/daftartransactions');
        $config['total_rows'] = $this->TransactionModel->count_all_transactions();
        $config['per_page']   = 10;
        $config['uri_segment'] = 3; // Sesuaikan dengan posisi angka di URL
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


        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['transactions'] = $this->TransactionModel->GetPaginationTransactions($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        $data['start']      = $page;
        $data['total']      = $config['total_rows'];

        $this->load->view('admin/daftartransactions', $data);
    }

    public function TambahBuku()
    {
        $this->load->view('admin/tambahbuku');
    }

    public function TambahUser()
    {
        $this->load->view('admin/tambahuser');
    }
    public function ExportCsv()
    {
        $this->load->model('TransactionModel');

        // 1. Ambil data dalam bentuk ARRAY, bukan Object.
        // Pastikan di model anda menggunakan result_array() atau kita konversi di sini.
        $transactions = $this->TransactionModel->GetAllTransactionAndJoin();

        if (ob_get_level()) ob_end_clean();

        $filename = 'transaksi_' . date('Ymd') . '.csv';

        header("Content-Type: text/csv; charset=utf-8");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        $file = fopen('php://output', 'w');

        $header = array("ID", "User ID", "Status", "Kode Transaksi", "Total Bayar", "Tanggal", "Username");
        fputcsv($file, $header);

        foreach ($transactions as $line) {
            $row = (array) $line;
            fputcsv($file, $row);
        }

        fclose($file);

        exit;
    }
}
