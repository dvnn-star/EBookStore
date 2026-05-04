<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Ganti 'Transaction_model' dengan nama file model Anda yang sebenarnya
        $this->load->model('TransactionModel','Transaction');

        // Proteksi tambahan yang kita bahas sebelumnya
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }
    public function index()
    {
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('login');
        }
        $user_id = $this->session->userdata('user_id');
        $result['data'] = $this->Transaction->getAllDataByUser($user_id);

        $this->load->view('pages/transactionPage', $result);
    }
    public function create()
    {
        if ($this->input->method() !== 'post') {
            show_error('Method does not match lol', 405);
        }

        return;
    }
}
