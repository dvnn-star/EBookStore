<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration
{

    public function up()
    {
        $this->load->dbforge();

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'role' => array(
                'type'       => 'ENUM',
                'constraint' => array('admin', 'user'), // Nilai yang diizinkan
                'default'    => 'user',                          // Sangat disarankan menentukan default
                'null'       => FALSE
            ),
     
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down()
    {
        $this->load->dbforge();
        $this->dbforge->drop_table('users', TRUE);
    }
}
