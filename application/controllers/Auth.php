<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function login()
    {

        // 1. Set aturan validasi
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan ke view login
            $this->load->view('login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // 2. Panggil Model untuk cek user
            $user = $this->User->get_by_email($email);

            if ($user) {
                // 3. Verifikasi Password (Password di DB harus hasil password_hash)
                if (password_verify($password, $user->password)) {

                    // 4. Siapkan data session
                    $session_data = [
                        'user_id'   => $user->id,
                        'username'  => $user->name,
                        'role'      => $user->role,
                        'logged_in' => TRUE
                    ];

                    // 5. Masukkan ke session
                    $this->session->set_userdata($session_data);

                    // 6. Keamanan tambahan: Regenerasi ID Session
                    session_regenerate_id(TRUE);
                    if ($user->role == 'admin') {

                        redirect('dashboard');
                    } else {
                        redirect($_ENV['BASE_URL']);
                    }
                } else {
                    $this->session->set_flashdata('error', 'Password salah.');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('error', 'Email tidak terdaftar.');
                redirect('login');
            }
        }
    }

    public function register()
    {
        // Proteksi: Jika sudah login, tidak boleh daftar lagi
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        // 1. Set Aturan Validasi
        $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]', [
            'matches' => 'Konfirmasi password tidak cocok!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Tampilkan view register jika validasi gagal atau baru akses halaman
            $this->load->view('register');
        } else {
            // 2. Data Valid: Siapkan Array untuk Database
            $data = [
                'name'     => $this->input->post('full_name', TRUE),
                'email'    => $this->input->post('email', TRUE),
                // WAJIB: Gunakan password_hash, jangan MD5!
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role'     => 'user', // Default role
                'created_at' => date('Y-m-d H:i:s')
            ];
            // 3. Simpan via Model
            $insert = $this->db->insert('users', $data);

            if ($insert) {
                $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat mendaftar.');
                redirect('register');
            }
        }
    }
    public function logout()
    {
        // Menghapus data dari kolom 'data' dan menghapus baris di tabel ci_sessions
        $this->session->sess_destroy();
        redirect('');
    }
}
