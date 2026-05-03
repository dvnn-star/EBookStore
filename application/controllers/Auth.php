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
            redirect('login');
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
                        redirect('');
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
    public function logout()
    {
        // Menghapus data dari kolom 'data' dan menghapus baris di tabel ci_sessions
        $this->session->sess_destroy();
        redirect('');
    }
}
