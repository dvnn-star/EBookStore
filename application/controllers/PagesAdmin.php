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
        if ($this->session->userdata('role') !== 'admin') {
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
        $config['uri_segment'] = 2; 
        $config['reuse_query_string'] = TRUE;

        // --- UPDATE CONFIG PAGINATION DASHBOARD ---
        $config['full_tag_open']    = '<nav class="flex items-center space-x-1.5">';
        $config['full_tag_close']   = '</nav>';
        
        // Nomor Halaman Biasa (Kontras Lebih Tinggi & Hover Deep Teal)
        $config['num_tag_open']     = '<span class="px-3.5 py-2 text-sm font-bold text-neutral-600 bg-white border border-neutral-200 rounded-xl hover:text-[#005B52] hover:bg-neutral-50 transition-colors">';
        $config['num_tag_close']    = '</span>';
        
        // Nomor Halaman AKTIF (Menggunakan Deep Teal #005B52 Solid)
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link px-3 py-1.5 text-sm font-bold text-white bg-[#005B52] rounded-lg">';
        $config['cur_tag_close']    = '</span></li>';
        
        // Tombol Next & Prev
        $config['next_link']        = 'Next &rarr;';
        $config['next_tag_open']    = '<span class="px-3.5 py-2 text-sm font-bold text-neutral-600 bg-white border border-neutral-200 rounded-xl hover:text-[#005B52] hover:bg-neutral-50 transition-colors">';
        $config['next_tag_close']   = '</span>';
        
        $config['prev_link']        = '&larr; Prev';
        $config['prev_tag_open']    = '<span class="px-3.5 py-2 text-sm font-bold text-neutral-600 bg-white border border-neutral-200 rounded-xl hover:text-[#005B52] hover:bg-neutral-50 transition-colors">';
        $config['prev_tag_close']   = '</span>';

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
        $config['uri_segment'] = 2; 
        $config['reuse_query_string'] = TRUE;

        // --- UPDATE CONFIG PAGINATION DAFTAR USER ---
        $config['full_tag_open']    = '<nav class="flex items-center space-x-1.5">';
        $config['full_tag_close']   = '</nav>';
        
        // Nomor Halaman Biasa
        $config['num_tag_open']     = '<span class="px-3.5 py-2 text-sm font-bold text-neutral-600 bg-white border border-neutral-200 rounded-xl hover:text-[#005B52] hover:bg-neutral-50 transition-colors">';
        $config['num_tag_close']    = '</span>';
        
        // Nomor Halaman AKTIF (Diubah dari Indigo ke Deep Teal #005B52)
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link px-3 py-1.5 text-sm font-bold text-white bg-[#005B52] rounded-lg">';
        $config['cur_tag_close']    = '</span></li>';
        
        // Tombol Next & Prev
        $config['next_link']        = 'Next &rarr;';
        $config['next_tag_open']    = '<span class="px-3.5 py-2 text-sm font-bold text-neutral-600 bg-white border border-neutral-200 rounded-xl hover:text-[#005B52] hover:bg-neutral-50 transition-colors">';
        $config['next_tag_close']   = '</span>';
        
        $config['prev_link']        = '&larr; Prev';
        $config['prev_tag_open']    = '<span class="px-3.5 py-2 text-sm font-bold text-neutral-600 bg-white border border-neutral-200 rounded-xl hover:text-[#005B52] hover:bg-neutral-50 transition-colors">';
        $config['prev_tag_close']   = '</span>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $data['users'] = $this->User->GetPaginationUser($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_colors = $this->pagination->create_links();
        $data['start']      = $page;
        $data['total']      = $config['total_rows'];

        $this->load->view('admin/daftaruser', $data);
    }

    public function DaftarTransactions()
    {
        $config['base_url']   = base_url('DaftarTransactions');
        $config['total_rows'] = $this->TransactionModel->count_all_transactions();
        $config['per_page']   = 10;
        $config['uri_segment'] = 2; 
        $config['reuse_query_string'] = TRUE;

        // --- UPDATE CONFIG PAGINATION DAFTAR TRANSAKSI ---
        $config['full_tag_open']    = '<nav class="flex items-center space-x-1.5">';
        $config['full_tag_close']   = '</nav>';
        
        // Nomor Halaman Biasa
        $config['num_tag_open']     = '<span class="px-3.5 py-2 text-sm font-bold text-neutral-600 bg-white border border-neutral-200 rounded-xl hover:text-[#005B52] hover:bg-neutral-50 transition-colors">';
        $config['num_tag_close']    = '</span>';
        
        // Nomor Halaman AKTIF (Diubah dari Indigo ke Deep Teal #005B52)
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link px-3 py-1.5 text-sm font-bold text-white bg-[#005B52] rounded-lg">';
        $config['cur_tag_close']    = '</span></li>';
        
        // Tombol Next & Prev
        $config['next_link']        = 'Next &rarr;';
        $config['next_tag_open']    = '<span class="px-3.5 py-2 text-sm font-bold text-neutral-600 bg-white border border-neutral-200 rounded-xl hover:text-[#005B52] hover:bg-neutral-50 transition-colors">';
        $config['next_tag_close']   = '</span>';
        
        $config['prev_link']        = '&larr; Prev';
        $config['prev_tag_open']    = '<span class="px-3.5 py-2 text-sm font-bold text-neutral-600 bg-white border border-neutral-200 rounded-xl hover:text-[#005B52] hover:bg-neutral-50 transition-colors">';
        $config['prev_tag_close']   = '</span>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

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

    // untuk edit transaksi 
    public function EditTransactions($slug)
    {
        $data['details'] = $this->TransactionModel->Get3TableJoin($slug);
        $this->load->view('admin/edittransaksi', $data);
    }

    public function UpdateStatus($kode_transaksi, $status)
    {
        if (!in_array($status, ['success', 'failed'])) {
            show_error("Aksi tidak valid.", 400);
        }

        $this->load->model('TransactionModel');
        $proses = $this->TransactionModel->ChangeStatus($kode_transaksi, $status);

        if ($proses) {
            redirect('DaftarTransactions/');
        } else {
            show_error("Gagal memperbarui transaksi. Transaksi mungkin sudah diproses sebelumnya kemungkinan transaksinya failed.", 500);
        }
    }
}