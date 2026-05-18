<?php

/**
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * @property CI_Load $load
 * @property CI_Model $TransactionModel
 * @property CI_Model $TransactionDetails
 */
defined('BASEPATH') or exit('No direct script access allowed');
class Payment extends CI_Controller
{
    public function execute_payment()
    {
        $this->load->model('TransactionDetails');
        $order_id = $this->input->post('order_id');
        
        if (!$order_id) {
            die("Akses ilegal: Order ID tidak ditemukan.");
        }

        $transaksi   = $this->TransactionModel->GetTransactionRecord($order_id);
        $nomor_admin = '6282268822307';
        $pesan = "Pesanan Baru EBookStore\n";
        $pesan .= "Invoice: #" . $transaksi->kode_transaksi . "\n";
        $pesan .= "Status: Awaiting payment\n";
        $pesan .= "Total Harga: Rp " . number_format($transaksi->total_bayar, 0, ',', '.') . "\n\n";
        $pesan .= "Halo Admin, saya ingin mengonfirmasi pembayaran untuk pesanan di atas. Mohon informasikan langkah selanjutnya.";

        $wa_link = "https://api.whatsapp.com/send?phone=" . $nomor_admin . "&text=" . urlencode($pesan);
        header("Location: " . $wa_link,true);
        exit;
    }
}
