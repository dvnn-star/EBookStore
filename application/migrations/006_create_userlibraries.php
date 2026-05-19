<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_userlibraries extends CI_Migration {
    public function up() {
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'user_id' => ['type' => 'int' ,'unsigned' => TRUE , 'null' => FALSE],
            'buku_id' => ['type' => 'INT', 'unsigned' => TRUE,'null' => FALSE],
            'created_at' => ['type' => 'date','null' => FALSE],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user_libraries', TRUE);

        // Foreign Keys
        $this->db->query("ALTER TABLE user_libraries ADD CONSTRAINT fk_user_libraries_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE");
        $this->db->query("ALTER TABLE user_libraries ADD CONSTRAINT fk_user_libraries_buku FOREIGN KEY (buku_id) REFERENCES Buku(id) ON DELETE CASCADE");
        $this->db->query("ALTER TABLE user_libraries ADD UNIQUE(user_id, buku_id)");
    }

    public function down() {
        $this->dbforge->drop_table('user_libraries', TRUE);
    }
}