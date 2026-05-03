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
}
