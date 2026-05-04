<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

    // Nama fungsi ini harus sama dengan yang ada di routes.php
    public function kategori()
    {
        // Logika: ambil data dari model (jika ada)
        // Lalu lempar ke tampilan (View)
        $this->load->model('Buku');
        $data['semua_buku'] = $this->Buku->getALL();
        $this->load->view('pages/kategori', $data);
    }


    // halaman login
    public function login()
    {
        if ($this->session->userdata('logged_in')) {

            redirect('');
        }
        $this->load->view('login');
    }
    public function register()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('');
        }
        $this->load->view('register');
    }
    public function terpopuler()
    {
        $this->load->view('pages/terpopuler');
    }
    public function about()
    {
        $this->load->view('pages/about');
    }

    public function dashboard()
    {
        if ($this->session->userdata('role') == 'admin') {

            $data = [];
            $data['data'] = $this->db->select('
        (SELECT COUNT(*) FROM users) as total_users,
        (SELECT COUNT(*) FROM Buku) as total_books,
        (SELECT COALESCE(SUM(total_bayar),0) FROM transactions WHERE status="success") as total_sales,
        ')->get()->row();
        $data['total_transactions'] = $this->db->get('transactions')->result();

            $this->load->view('admin/dashboard', $data);
        } else {
            show_error('You do not have permission to access this resource.', 403);
        }
    }
}
