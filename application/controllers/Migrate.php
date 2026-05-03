<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

    public function index() {
        $this->load->database();
        $this->load->library('migration');

        if ($this->migration->current() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migration sukses";
        }
    }
    public function reset() {
        // Hanya izinkan di lingkungan development
        if (ENVIRONMENT !== 'development') {
            die("Hanya boleh dijalankan di mode development!");
        }

        $this->load->dbforge();
        
        // Ambil semua tabel
        $tables = $this->db->list_tables();

        // Matikan Foreign Key Check agar bisa drop tabel yang berelasi
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        
        foreach ($tables as $table) {
            $this->dbforge->drop_table($table, TRUE);
        }
        
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        echo "Database dibersihkan. Sekarang jalankan migrasi ulang.";
    }
}