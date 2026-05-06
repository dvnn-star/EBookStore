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
            $this->session->set_flashdata('success', 'Data buku berhasil diperbarui!');
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
}
