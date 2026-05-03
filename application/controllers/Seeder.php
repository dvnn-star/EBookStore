<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seeder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Proteksi: Hanya bisa dijalankan di mode development atau CLI
        if (ENVIRONMENT !== 'development' && !is_cli()) {
            show_error('Akses tidak diizinkan.');
        }
    }

    public function seed_buku()
    {
        $this->db->truncate('Buku'); // Menghapus data lama agar tidak duplikat saat testing

        $data = [
            [
                'gambar'     => 'rich-dad-poor-dad.jpg',
                'judul_buku' => 'Rich Dad Poor Dad',
                'penulis'    => 'Robert T. Kiyosaki',
                'penerbit'   => 'Gramedia Pustaka Utama',
                'deskripsi'  => 'Buku klasik tentang pengelolaan keuangan pribadi dan investasi.',
                'harga'      => 95000.00,
                'halaman'    => 336,
                'rating'     => 5,
                'kategori'   => 'bisnis&ekonomi'
            ],
            [
                'gambar'     => 'laskar-pelangi.jpg',
                'judul_buku' => 'Laskar Pelangi',
                'penulis'    => 'Andrea Hirata',
                'penerbit'   => 'Bentang Pustaka',
                'deskripsi'  => 'Kisah perjuangan sepuluh anak di Belitung dalam menempuh pendidikan.',
                'harga'      => 89000.00,
                'halaman'    => 529,
                'rating'     => 5,
                'kategori'   => 'fiksi'
            ],
            [
                'gambar'     => 'sapiens.jpg',
                'judul_buku' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'penulis'    => 'Yuval Noah Harari',
                'penerbit'   => 'Kepustakaan Populer Gramedia',
                'deskripsi'  => 'Menjelajahi sejarah umat manusia dari Zaman Batu hingga masa depan.',
                'harga'      => 150000.00,
                'halaman'    => 544,
                'rating'     => 4,
                'kategori'   => 'sejarah'
            ],
            [
                'gambar'     => 'belajar-php.jpg',
                'judul_buku' => 'Mastering CodeIgniter 3',
                'penulis'    => 'Delvin Dev',
                'penerbit'   => 'Informatika',
                'deskripsi'  => 'Panduan lengkap membangun web dinamis dengan CI3 untuk pemula.',
                'harga'      => 75000.00,
                'halaman'    => 250,
                'rating'     => 4,
                'kategori'   => 'edukasi'
            ]
        ];

        if ($this->db->insert_batch('Buku', $data)) {
            echo "Seeding Tabel Buku Berhasil!" . PHP_EOL;
        } else {
            echo "Gagal melakukan seeding.";
        }
    }
    public function seed_users()
    {
        $this->db->truncate('users');
        $data = [
            [
                'name' => 'delvin',
                'email' => 'delvinn12.0@gmail.com',
                'password' => 'delvin',
                'role' => 'admin'
            ],
            [
                'name' => 'adi',
                'email' => 'adi@test.com',
                'password' => password_hash('adi12',PASSWORD_DEFAULT),
                'role' => 'user'
            ]

        ];
        if ($this->db->insert_batch('users', $data)) {
            echo('seeding data berhasil');
        }
        else{
            echo "gagal seeding";
        }
    }
}
