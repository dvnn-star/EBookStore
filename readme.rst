# E-BookStore | Management System

Sistem Manajemen Inventaris dan Pengguna berbasis web yang dibangun untuk kebutuhan operasional toko buku digital. Proyek ini memprioritaskan antarmuka admin yang bersih (clean UI), keamanan data, dan pengelolaan katalog buku yang efisien.

## 🚀 Fitur Utama

*   **Manajemen Pengguna (User Management):** Operasi CRUD lengkap (Create, Read, Update, Delete) untuk mengelola akun admin dan pelanggan.
*   **Katalog Buku (Book Inventory):** Pengelolaan data buku termasuk deskripsi sinopsis, rating, dan integrasi unggah gambar (cover buku).
*   **Role-Based Access Control (RBAC):** Diferensiasi hak akses antara Administrator dan User reguler.
*   **UI Modern & Responsif:** Antarmuka dibangun menggunakan Tailwind CSS dengan tipografi Inter untuk keterbacaan maksimal.
*   **Validasi Data Kuat:** Penanganan error input secara spesifik untuk menjaga integritas database.

## 🛠️ Tech Stack

*   **Core Framework:** CodeIgniter 3.1.13 (PHP)
*   **Styling:** Tailwind CSS (via CDN/Tailwind CLI)
*   **Database:** MySQL / MariaDB
*   **Font:** Inter (Google Fonts)
*   **Environment:** Native LAMP (Linux, Apache, MySQL, PHP)

## 📦 Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di lingkungan lokal:

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/username/ebookstore.git](https://github.com/username/ebookstore.git)
2.  **cp .ev.example ke .env**
    atur .env nya sesuai yang diinginkan 
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => 'password_anda',
    'database' => 'ebookstore',
3.  **Konfigurasi Base URL**
    *   Buka `application/config/config.php` dan sesuaikan:
        ```php
        $config['base_url'] = 'http://localhost/ebookstore/';
        ```

4.  **Akses Aplikasi**
    *   Buka browser dan akses `http://localhost/ebookstore/`

## 📂 Struktur Direktori Utama

*   `application/controllers/`: Logika bisnis dan alur navigasi (DaftarUser.php, DaftarBuku.php).
*   `application/models/`: Interaksi database.
*   `application/views/`: Komponen UI dan layout (Dashboard, Edit, Tambah).
*   `uploads/`: Direktori penyimpanan file gambar cover buku.

## 🛡️ Keamanan & Optimasi

*   Menggunakan `html_escape()` untuk mencegah serangan XSS pada output data.
*   Implementasi `form_validation` untuk menyaring input ilegal.
*   Pemisahan komponen UI menggunakan `load->view('components/...')` untuk menjaga prinsip DRY (*Don't Repeat Yourself*).

---
**Author:** Delvin ,Adi,Edy