<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_transactions extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'kode_transaksi' => ['type' => 'VARCHAR', 'constraint' => 20],
            'total_bayar' => ['type' => 'DECIMAL', 'constraint' => '15,2'],
            'tanggal' => ['type' => 'DATETIME'],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('transactions', TRUE);

        // Foreign Key ke Users
        $this->db->query("ALTER TABLE transactions ADD CONSTRAINT fk_transactions_user FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE RESTRICT");
    }

    public function down()
    {
        $this->dbforge->drop_table('transactions', TRUE);
    }
}
