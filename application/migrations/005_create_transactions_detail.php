<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_transactions_detail extends CI_Migration {
    public function up() {
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'transactions_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'buku_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'qty' => ['type' => 'INT', 'constraint' => 11],
            'harga_beli' => ['type' => 'DECIMAL', 'constraint' => '15,2'],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('transactions_detail', TRUE);

        // Foreign Keys
        $this->db->query("ALTER TABLE transactions_detail ADD CONSTRAINT fk_detail_trx_id FOREIGN KEY (transactions_id) REFERENCES transactions(id) ON DELETE CASCADE");
        $this->db->query("ALTER TABLE transactions_detail ADD CONSTRAINT fk_detail_Buku FOREIGN KEY (Buku_id) REFERENCES Buku(id) ON DELETE RESTRICT");
    }

    public function down() {
        $this->dbforge->drop_table('transactions_detail', TRUE);
    }
}