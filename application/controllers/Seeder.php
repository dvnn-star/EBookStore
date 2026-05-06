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
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $this->db->truncate('Buku');

        $data = [
            // 1-4 (Data Original Anda)
            ['gambar' => 'rich-dad-poor-dad.jpg', 'judul_buku' => 'Rich Dad Poor Dad', 'penulis' => 'Robert T. Kiyosaki', 'penerbit' => 'Gramedia', 'deskripsi' => 'Buku klasik tentang pengelolaan keuangan pribadi.', 'harga' => 95000, 'halaman' => 336, 'rating' => 5, 'kategori' => 'bisnis&ekonomi'],
            ['gambar' => 'laskar-pelangi.jpg', 'judul_buku' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'penerbit' => 'Bentang Pustaka', 'deskripsi' => 'Kisah perjuangan anak Belitung.', 'harga' => 89000, 'halaman' => 529, 'rating' => 5, 'kategori' => 'fiksi'],
            ['gambar' => 'sapiens.jpg', 'judul_buku' => 'Sapiens', 'penulis' => 'Yuval Noah Harari', 'penerbit' => 'KPG', 'deskripsi' => 'Sejarah singkat umat manusia.', 'harga' => 150000, 'halaman' => 544, 'rating' => 4, 'kategori' => 'sejarah'],
            ['gambar' => 'belajar-php.jpg', 'judul_buku' => 'Mastering CodeIgniter 3', 'penulis' => 'Delvin Dev', 'penerbit' => 'Informatika', 'deskripsi' => 'Panduan lengkap membangun web dengan CI3.', 'harga' => 75000, 'halaman' => 250, 'rating' => 4, 'kategori' => 'edukasi'],

            // 5-15 (Pengembangan Diri & Bisnis)
            ['gambar' => 'atomic-habits.jpg', 'judul_buku' => 'Atomic Habits', 'penulis' => 'James Clear', 'penerbit' => 'Gramedia', 'deskripsi' => 'Cara mudah membangun kebiasaan baik.', 'harga' => 108000, 'halaman' => 356, 'rating' => 5, 'kategori' => 'edukasi'],
            ['gambar' => 'filosofi-teras.jpg', 'judul_buku' => 'Filosofi Teras', 'penulis' => 'Henry Manampiring', 'penerbit' => 'Kompas', 'deskripsi' => 'Filsafat Stoa untuk mental yang tangguh.', 'harga' => 98000, 'halaman' => 320, 'rating' => 5, 'kategori' => 'edukasi'],
            ['gambar' => 'psychology-of-money.jpg', 'judul_buku' => 'The Psychology of Money', 'penulis' => 'Morgan Housel', 'penerbit' => 'Baca', 'deskripsi' => 'Pelajaran abadi mengenai kekayaan dan kebahagiaan.', 'harga' => 85000, 'halaman' => 262, 'rating' => 5, 'kategori' => 'bisnis&ekonomi'],
            ['gambar' => 'start-with-why.jpg', 'judul_buku' => 'Start with Why', 'penulis' => 'Simon Sinek', 'penerbit' => 'Gramedia', 'deskripsi' => 'Bagaimana pemimpin besar menginspirasi orang lain.', 'harga' => 90000, 'halaman' => 256, 'rating' => 4, 'kategori' => 'bisnis&ekonomi'],
            ['gambar' => 'zero-to-one.jpg', 'judul_buku' => 'Zero to One', 'penulis' => 'Peter Thiel', 'penerbit' => 'Gramedia', 'deskripsi' => 'Membangun masa depan melalui startup.', 'harga' => 88000, 'halaman' => 210, 'rating' => 4, 'kategori' => 'bisnis&ekonomi'],
            ['gambar' => 'deep-work.jpg', 'judul_buku' => 'Deep Work', 'penulis' => 'Cal Newport', 'penerbit' => 'Alvabet', 'deskripsi' => 'Fokus di dunia yang penuh gangguan.', 'harga' => 79000, 'halaman' => 300, 'rating' => 4, 'kategori' => 'edukasi'],
            ['gambar' => 'grit.jpg', 'judul_buku' => 'Grit', 'penulis' => 'Angela Duckworth', 'penerbit' => 'Gramedia', 'deskripsi' => 'Kekuatan kegigihan dan gairah.', 'harga' => 110000, 'halaman' => 450, 'rating' => 5, 'kategori' => 'edukasi'],
            ['gambar' => 'ikigai.jpg', 'judul_buku' => 'Ikigai', 'penulis' => 'Hector Garcia', 'penerbit' => 'Gramedia', 'deskripsi' => 'Rahasia hidup bahagia orang Jepang.', 'harga' => 70000, 'halaman' => 200, 'rating' => 4, 'kategori' => 'edukasi'],
            ['gambar' => 'shoe-dog.jpg', 'judul_buku' => 'Shoe Dog', 'penulis' => 'Phil Knight', 'penerbit' => 'Gramedia', 'deskripsi' => 'Memoar pendiri Nike.', 'harga' => 135000, 'halaman' => 400, 'rating' => 5, 'kategori' => 'bisnis&ekonomi'],
            ['gambar' => 'the-alchemist.jpg', 'judul_buku' => 'The Alchemist', 'penulis' => 'Paulo Coelho', 'penerbit' => 'Gramedia', 'deskripsi' => 'Mengejar mimpi dan takdir.', 'harga' => 65000, 'halaman' => 216, 'rating' => 5, 'kategori' => 'fiksi'],
            ['gambar' => 'meditations.jpg', 'judul_buku' => 'Meditations', 'penulis' => 'Marcus Aurelius', 'penerbit' => 'Turos', 'deskripsi' => 'Renungan kaisar romawi tentang hidup.', 'harga' => 80000, 'halaman' => 280, 'rating' => 4, 'kategori' => 'sejarah'],

            // 16-25 (Fiksi & Sastra)
            ['gambar' => 'bumi.jpg', 'judul_buku' => 'Bumi', 'penulis' => 'Tere Liye', 'penerbit' => 'Gramedia', 'deskripsi' => 'Petualangan dunia paralel.', 'harga' => 95000, 'halaman' => 440, 'rating' => 4, 'kategori' => 'fiksi'],
            ['gambar' => 'laut-bercerita.jpg', 'judul_buku' => 'Laut Bercerita', 'penulis' => 'Leila S. Chudori', 'penerbit' => 'KPG', 'deskripsi' => 'Kisah kelam aktivis 1998.', 'harga' => 115000, 'halaman' => 400, 'rating' => 5, 'kategori' => 'fiksi'],
            ['gambar' => 'cantik-itu-luka.jpg', 'judul_buku' => 'Cantik Itu Luka', 'penulis' => 'Eka Kurniawan', 'penerbit' => 'Gramedia', 'deskripsi' => 'Realisme magis sejarah Indonesia.', 'harga' => 125000, 'halaman' => 500, 'rating' => 5, 'kategori' => 'fiksi'],
            ['gambar' => 'negeri-5-menara.jpg', 'judul_buku' => 'Negeri 5 Menara', 'penulis' => 'A. Fuadi', 'penerbit' => 'Gramedia', 'deskripsi' => 'Man Jadda Wajada, santri dan impiannya.', 'harga' => 85000, 'halaman' => 420, 'rating' => 4, 'kategori' => 'fiksi'],
            ['gambar' => '1984.jpg', 'judul_buku' => '1984', 'penulis' => 'George Orwell', 'penerbit' => 'Bentang', 'deskripsi' => 'Distopia tentang pengawasan pemerintah.', 'harga' => 75000, 'halaman' => 320, 'rating' => 5, 'kategori' => 'fiksi'],
            ['gambar' => 'pulang.jpg', 'judul_buku' => 'Pulang', 'penulis' => 'Leila S. Chudori', 'penerbit' => 'KPG', 'deskripsi' => 'Eksil politik di Paris.', 'harga' => 90000, 'halaman' => 460, 'rating' => 4, 'kategori' => 'fiksi'],
            ['gambar' => 'perahu-kertas.jpg', 'judul_buku' => 'Perahu Kertas', 'penulis' => 'Dee Lestari', 'penerbit' => 'Bentang', 'deskripsi' => 'Kisah cinta dan pencarian jati diri.', 'harga' => 88000, 'halaman' => 444, 'rating' => 4, 'kategori' => 'fiksi'],
            ['gambar' => 'hujan.jpg', 'judul_buku' => 'Hujan', 'penulis' => 'Tere Liye', 'penerbit' => 'Gramedia', 'deskripsi' => 'Cinta dan teknologi di masa depan.', 'harga' => 85000, 'halaman' => 320, 'rating' => 4, 'kategori' => 'fiksi'],
            ['gambar' => 'dunia-sophie.jpg', 'judul_buku' => 'Dunia Sophie', 'penulis' => 'Jostein Gaarder', 'penerbit' => 'Mizan', 'deskripsi' => 'Sejarah filsafat dalam bentuk novel.', 'harga' => 145000, 'halaman' => 800, 'rating' => 5, 'kategori' => 'edukasi'],
            ['gambar' => 'serangkai.jpg', 'judul_buku' => 'Serangkai', 'penulis' => 'Valerie Patkar', 'penerbit' => 'Bhuana Ilmu Populer', 'deskripsi' => 'Tentang kehilangan dan memulai kembali.', 'harga' => 99000, 'halaman' => 300, 'rating' => 4, 'kategori' => 'fiksi'],

            // 26-30 (Teknologi & Sains)
            ['gambar' => 'clean-code.jpg', 'judul_buku' => 'Clean Code', 'penulis' => 'Robert C. Martin', 'penerbit' => 'Pearson', 'deskripsi' => 'Panduan menulis kode yang rapi.', 'harga' => 450000, 'halaman' => 464, 'rating' => 5, 'kategori' => 'edukasi'],
            ['gambar' => 'homo-deus.jpg', 'judul_buku' => 'Homo Deus', 'penulis' => 'Yuval Noah Harari', 'penerbit' => 'KPG', 'deskripsi' => 'Masa depan umat manusia.', 'harga' => 140000, 'halaman' => 520, 'rating' => 4, 'kategori' => 'sejarah'],
            ['gambar' => 'elon-musk.jpg', 'judul_buku' => 'Elon Musk', 'penulis' => 'Ashlee Vance', 'penerbit' => 'Gramedia', 'deskripsi' => 'Biografi inovator SpaceX dan Tesla.', 'harga' => 120000, 'halaman' => 440, 'rating' => 4, 'kategori' => 'bisnis&ekonomi'],
            ['gambar' => 'steve-jobs.jpg', 'judul_buku' => 'Steve Jobs', 'penulis' => 'Walter Isaacson', 'penerbit' => 'Bentang', 'deskripsi' => 'Kisah hidup pendiri Apple.', 'harga' => 150000, 'halaman' => 600, 'rating' => 5, 'kategori' => 'bisnis&ekonomi'],
            ['gambar' => 'brief-history-time.jpg', 'judul_buku' => 'A Brief History of Time', 'penulis' => 'Stephen Hawking', 'penerbit' => 'Gramedia', 'deskripsi' => 'Mengenal asal usul alam semesta.', 'harga' => 95000, 'halaman' => 250, 'rating' => 5, 'kategori' => 'sejarah']
        ];

        if ($this->db->insert_batch('Buku', $data)) {
            $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
            echo "Seeding Tabel Buku Berhasil! (30 Buku ditambahkan)" . PHP_EOL;
        } else {
            $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
            echo "Gagal melakukan seeding.";
        }
    }
    public function seed_users()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0'); // Menghapus data lama agar tidak duplikat saat testing
        $this->db->truncate('users');

        $data = [
            [
                'name' => 'delvin',
                'email' => 'delvinn12.0@gmail.com',
                'password' => password_hash('delvin', PASSWORD_DEFAULT),
                'role' => 'admin'
            ],
            [
                'name' => 'adi',
                'email' => 'adi@test.com',
                'password' => password_hash('adi12', PASSWORD_DEFAULT),
                'role' => 'user'
            ]

        ];
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        if ($this->db->insert_batch('users', $data)) {
            echo ('seeding data berhasil');
        } else {
            echo "gagal seeding";
        }
    }
}
