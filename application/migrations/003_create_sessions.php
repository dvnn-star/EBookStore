<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_sessions extends CI_Migration
{
    public function up()
    {
        $this->load->dbforge();

        // Struktur tabel session WAJIB mengikuti standar CI3 agar driver database bekerja
        $this->dbforge->add_field(array(
            'id' => array(
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'null'       => FALSE
            ),
            'ip_address' => array(
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => FALSE
            ),
            'timestamp' => array(
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => TRUE,
                'default'    => 0,
                'null'       => FALSE
            ),
            'data' => array(
                'type' => 'BLOB', // Tempat menyimpan userdata (id_user, role, dll) secara otomatis
                'null' => FALSE
            ),
  
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('timestamp'); // Penting untuk performa saat pembersihan session lama
        
        $this->dbforge->create_table('sessions');
    }

    public function down()
    {
        $this->dbforge->drop_table('sessions');
    }
}