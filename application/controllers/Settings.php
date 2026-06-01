<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Guard Clause: Tendang user jika belum login
        if (!$this->session->userdata('logged_in')) {
            redirect('login'); 
        }
        $this->load->library('form_validation');
    }

    public function index() {
        // Ambil data user terbaru langsung dari database untuk dilempar ke form
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('users', ['id' => $user_id])->row();

        $this->load->view('settings/index', $data);
    }

    public function update() {
        $user_id = $this->session->userdata('user_id');
        
        // Aturan validasi input
        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('settings');
        }

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // 1. Validasi Email Unik (Jangan sampai menabrak email milik user lain)
        $email_check = $this->db->get_where('users', ['email' => $email, 'id !=' => $user_id])->row();
        if ($email_check) {
            $this->session->set_flashdata('error', 'Email sudah digunakan oleh akun lain!');
            redirect('settings');
        }

        // 2. Siapkan data untuk di-update
        $update_data = [
            'name'  => $name,
            'email' => $email
        ];

        if (!empty($password)) {
            if (strlen($password) < 6) {
                $this->session->set_flashdata('error', 'Password minimal harus 6 karakter!');
                redirect('settings');
            }
            $update_data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        // 4. Eksekusi Update ke Database
        $this->db->where('id', $user_id)->update('users', $update_data);

        // 5. TITIK BUTA SINKRONISASI SESSION: Update session agar tampilan FE ikut berubah instan
        $this->session->set_userdata('name', $name);
        $this->session->set_userdata('email', $email);

        $this->session->set_flashdata('success', 'Profil dan keamanan berhasil diperbarui!');
        redirect('settings');
    }
}