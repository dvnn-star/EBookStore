<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    // Nama fungsi ini harus sama dengan yang ada di routes.php
    public function kategori() {
        // Logika: ambil data dari model (jika ada)
        // Lalu lempar ke tampilan (View)
        $this->load->view('pages/kategori'); 
    }
}