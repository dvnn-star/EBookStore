<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function kategori() {
        echo "Ini halaman kategori"; 
        // atau $this->load->view('nama_view_kategori');
    }
}