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
        $this->load->view('login');
    }
    public function register()
    {
        $this->load->view('register');
    }
}
