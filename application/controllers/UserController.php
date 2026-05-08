<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UserController extends CI_Controller
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
        if (ENVIRONMENT !== 'development' && !is_cli()) {
            show_error('Akses tidak diizinkan.');
        }
    }
    public function EditUser($slug)
    {
        $data['users'] = $this->db->get_where('users', ['id' => $slug])->row();
        $this->load->view('admin/showuser', $data);
    }

    public function UpdateUser($slug)
    {
        // 1. Proteksi Method
        if ($this->input->method() !== 'post') {
            show_error('Method Not Allowed', 405);
        }

        $user_lama = $this->User->getById($slug);
        if (!$user_lama) {
            show_404();
        }

        $id_buku = $user_lama->id;

        $data = [
            'name' => $this->input->post('name', true),
            'email'    => $this->input->post('email', true),
            'role'   => $this->input->post('role', true),

        ];



        $update_status = $this->User->update($id_buku, $data);

        if ($update_status) {
            $this->session->set_flashdata('perubahan', 'Data buku berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui database.');
        }
        redirect('DaftarUser');
    }
    public function Delete($slug)
    {
        $this->User->delete($slug);
        $this->session->set_flashdata('message', 'Data deleted successfully!');
        redirect('DaftarUser');
    }
    public function StoreUser()
    {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
        $this->form_validation->set_rules('role', 'role', 'required');
        $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]', [
            'matches' => 'Konfirmasi password tidak cocok!'
        ]);
        $check_email = $this->User->CheckEmailInDatabase($this->input->post('email'));
    
        if ($this->form_validation->run() == FALSE  or  $check_email == TRUE) {
            $error = validation_errors();

            if ($check_email) {
                $error .= 'Email sudah digunakan';
            }
            $this->session->set_flashdata('error', $error);
            $this->session->set_flashdata('old_input', $this->input->post());
            redirect('DaftarUser/tambah_user');
        }
        try {

            $data = [
                'name' => $this->input->post('name', true),
                'password' => $this->input->post('password', true),
                'email' => $this->input->post('email', true),
                'role' => $this->input->post('role', true),
            ];
            $this->User->insert($data);
            $this->session->set_flashdata('success', 'data berhasil dimasukkan');
            redirect('DaftarUser');
        } catch (\Throwable $th) {
            $this->session->set_flashdata('error', 'data  tidak berhasil dimasukkan');
            redirect('DaftarUser/tambah_user');
        }
    }
}
