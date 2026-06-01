<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function login()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan ke view login
            redirect('login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');


            $user = $this->User->get_by_email($email);

            if ($user) {
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

    public function register()
    {
        // Proteksi: Jika sudah login, tidak boleh daftar lagi
        if ($this->session->userdata('logged_in') and $this->user->role == 'admin') {
            redirect('dashboard');
            return;
        }


        $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[50]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]', [
            'matches' => 'Konfirmasi password tidak cocok!'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('old_input', $this->input->post());
            redirect('register');
        } else {
            $data = [
                'name'       => $this->input->post('full_name', TRUE),
                'email'      => $this->input->post('email', TRUE),
                'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role'       => 'user', // Default role
            ];

            try {
                $insert = $this->db->insert('users', $data);
                if ($insert) {
                    $user_id = $this->db->insert_id();


                    $user_info = $this->db->get_where('users', ['id' => $user_id])->row();

                    if ($user_info) {
                        $session_data = [
                            'user_id'   => $user_info->id,
                            'username' => $user_info->name, 
                            'role'      => $user_info->role,
                            'logged_in' => TRUE
                        ];
                        $this->session->set_userdata($session_data);
                        session_regenerate_id(TRUE);

                        // 6. Keamanan tambahan: Regenerasi ID Session
                        $this->session->set_flashdata('success', 'Registrasi berhasil! ' . $user_info->name);

                        redirect('');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
                    redirect('register');
                }
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Error: ' . $e->getMessage());
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
