<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class BukuController extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->library('pagination');
            if (!$this->session->userdata('logged_in')) {
                redirect('login');
            }
            if (!$this->session->userdata('role') === 'admin') {
                show_error('You do not have permission to access this resource.', 403);
            }
            // Proteksi: Hanya bisa dijalankan di mode development atau CLI
            if (ENVIRONMENT !== 'development' && !is_cli()) {
                show_error('Akses tidak diizinkan.');
            }
        }
        public function DaftarBuku()
        {
            $config['base_url']   = base_url('DaftarBuku');
            $config['total_rows'] = $this->Buku->count_all_books();
            $config['per_page']   = 10;
            $config['uri_segment'] = 2; // Sesuaikan dengan posisi angka di URL
            $config['reuse_query_string'] = TRUE;

            $config['full_tag_open']    = '<nav class="flex items-center space-x-2">';
            $config['full_tag_close']   = '</nav>';
            $config['num_tag_open']     = '<span class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50">';
            $config['num_tag_close']    = '</span>';
            $config['cur_tag_open']     = '<span class="px-4 py-2 text-sm font-bold text-white bg-indigo-600 border border-indigo-600 rounded-lg shadow-sm">';
            $config['cur_tag_close']    = '</span>';
            $config['next_link']        = 'Next &rarr;';
            $config['prev_link']        = '&larr; Prev';


            $this->pagination->initialize($config);


            // Ambil offset dari URL (default 0)
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $data['books'] = $this->Buku->GetPaginationBooks($config['per_page'], $page);
            $data['pagination'] = $this->pagination->create_links();
            $data['start']      = $page;
            $data['total']      = $config['total_rows'];

            $this->load->view('admin/daftarbuku', $data);
        }
        public function UpdateBuku($slug)
        {
            // 1. Proteksi Method
            if ($this->input->method() !== 'post') {
                show_error('Method Not Allowed', 405);
            }

            // 2. Ambil data lama & Validasi Eksistensi
            $buku_lama = $this->Buku->getById($slug);
            if (!$buku_lama) {
                show_404();
            }

            // Definisikan ID dari data yang sudah ditemukan
            $id_buku = $buku_lama->id;

            // 3. Siapkan data teks
            $data = [
                'judul_buku' => $this->input->post('judul_buku', true),
                'penulis'    => $this->input->post('penulis', true),
                'penerbit'   => $this->input->post('penerbit', true),
                'deskripsi'  => $this->input->post('deskripsi', true),
                'harga'      => $this->input->post('harga', true),
                'halaman'    => $this->input->post('halaman', true),
                'rating'     => $this->input->post('rating', true),
                'kategori'   => $this->input->post('kategori', true),
            ];

            // 4. Handle Upload Gambar
            if (!empty($_FILES['gambar']['name'])) {

                $path_target = './assets/images/'; // Standarisasi satu path

                $config['upload_path']   = $path_target;
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size']      = 2048;
                $config['file_name']     = 'book_' . time() . '_' . uniqid();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('gambar')) {
                    $new_file = $this->upload->data('file_name');
                    $data['gambar'] = $new_file;

                    // HAPUS GAMBAR LAMA (Gunakan path yang sama dengan upload)
                    // Cek apakah bukan file default dan apakah file fisiknya ada
                    $old_file = $path_target . $buku_lama->gambar;
                    if ($buku_lama->gambar !== 'default.jpeg' && file_exists($old_file)) {
                        unlink($old_file);
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());

                    redirect('DaftarBuku/edit' . $slug); // Kembalikan ke halaman edit menggunakan slug
                    return;
                }
            }

            // 5. Eksekusi Update menggunakan ID yang valid
            $update_status = $this->Buku->update($id_buku, $data);

            if ($update_status) {
                $this->session->set_flashdata('success', 'Data buku berhasil diperbarui!');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui database.');
            }
            redirect('DaftarBuku');
        }
        public function EditBuku($slug)
        {
            $data['buku'] = $this->db->get_where('Buku', ['id' => $slug])->row();
            $this->load->view('admin/showbuku', $data);
        }
        public function Delete($slug)
        {
            $this->Buku->delete($slug);
            $this->session->set_flashdata('message', 'Data deleted successfully!');
            redirect('DaftarBuku');
        }


        public function TambahBuku()
        {
            ini_set('memory_limit', '512M');
            $this->form_validation->set_rules('judul_buku', 'judul_buku', 'required|trim');
            $this->form_validation->set_rules('penulis', 'penulis', 'required|trim');
            $this->form_validation->set_rules('harga', 'harga', 'required|numeric');
            $this->form_validation->set_rules('kategori', 'kategori', 'required');
            $this->form_validation->set_rules('penerbit', 'penerbit', 'required');
            $this->form_validation->set_rules('halaman', 'halaman', 'required');
            $this->form_validation->set_rules('rating', 'rating', 'required|numeric');
            $check_judul = $this->Buku->CheckJudulDiDatabase($this->input->post('judul_buku'));
            if ($this->form_validation->run() == FALSE || $check_judul) {
                $error = validation_errors();

                if ($check_judul){
                    $error .= 'Judul Buku ini sudah ada ';
                    $this->session->set_flashdata('old_input', $this->input->post());
                }
                $this->session->set_flashdata('error',$error);
                redirect('DaftarBuku/tambah_buku');
            } else {
                // 3. Konfigurasi Upload Gambar
                $config['upload_path']   = './assets/images/'; // Pastikan folder ini ada
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = 2048; // 2MB
                $config['file_name']     = 'cover-' . time(); // Rename file agar unik

                $this->load->library('upload', $config);
                
                $this->upload->initialize($config, true); // Parameter true akan mereset konfigurasi sebelumnya
                if (!$this->upload->do_upload('gambar')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('DaftarBuku/tambah_buku');
                } else {
                    // Jika upload berhasil, ambil nama filenya
                    $upload_data = $this->upload->data();
                    $file_name   = $upload_data['file_name'];

                    // 4. Siapkan Data untuk Database
                    $data = [
                        'judul_buku' => $this->input->post('judul_buku', true),
                        'penulis'    => $this->input->post('penulis', true),
                        'penerbit'   => $this->input->post('penerbit', true),
                        'kategori'   => $this->input->post('kategori', true),
                        'deskripsi'  => $this->input->post('deskripsi', true),
                        'harga'      => $this->input->post('harga', true),
                        'halaman'    => $this->input->post('halaman', true),
                        'rating'     => $this->input->post('rating', true),
                        'gambar'     => $file_name
                    ];

                    if ($this->Buku->insert_buku($data)) {
                        $this->session->set_flashdata('success', 'Buku berhasil ditambahkan ke katalog!');
                        redirect('DaftarBuku');
                    } else {
                        $this->session->set_flashdata('error', 'Gagal menyimpan data ke database.');
                        redirect('DaftarBuku/TambahBuku');
                    }
                }
            }
        }
    }
