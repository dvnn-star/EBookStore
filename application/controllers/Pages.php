<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{


    // Nama fungsi ini harus sama dengan yang ada di routes.php
    public function kategori()
    {
        // Logika: ambil data dari model (jika ada)
        // Lalu lempar ke tampilan (View)
        $user_id = $this->session->userdata('user_id') ?? 0;
        $this->load->model('User_libraries');
        $data['semua_buku'] = $this->User_libraries->get_katalog_with_status($user_id);
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

        $semua_buku = $this->Buku->GetHighRating();

        $koleksi = [];

        foreach ($semua_buku as $b) {
            $kat = $b->kategori;

            if (!isset($koleksi[$kat])) {
                $koleksi[$kat] = [
                    'judul' => ucwords(str_replace('&', ' & ', $kat)),
                    'data'  => []
                ];
            }
            $koleksi[$kat]['data'][] = $b;
        }

        $data['koleksi_buku'] = $koleksi;
        $this->load->view('pages/terpopuler', $data);
    }
    public function about()
    {
        $this->load->view('pages/about');
    }
    public function keranjang()
    {
        $this->load->view('pages/keranjang');
    }
    public function payment($slug)
    {
        $this->load->model('TransactionModel');
        $transactions = $this->TransactionModel->GetTransactionRecord($slug);
        if (!$transactions or $transactions->user_id !=  $this->session->userdata('user_id')) {
            show_error('unathorized', 401);
        } 
        if ($transactions->status == 'success') {
            show_error('pembayaran berhasil', 404);
        }

        $data['transaction'] = $transactions;
        $data['details'] = $this->db->select('
        transactions_detail.qty,
        transactions_detail.harga_beli,
        Buku.judul_buku,
        Buku.penulis,
        Buku.harga')
            ->from('transactions_detail')
            ->join('Buku', 'Buku.id = transactions_detail.buku_id', 'inner')->where('transactions_detail.transactions_id', $transactions->id)->get()->result();

        $this->load->view('payments/index', $data);
    }
    public function mybooks($slug)
    {
        $this->load->model('User_libraries');
        if ($this->session->userdata('user_id') != $slug){
            show_error('gabisa brow',403);
        }
        $data['books'] = $this->User_libraries->getdatabyuserid($slug);

        $this->load->view('pages/Bukusaya',$data);
    }
}
  