<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_buku extends CI_Migration
{

    public function up()
    {
        $this->load->dbforge();

        $this->dbforge->add_field(array(
            'id' => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ),
            'gambar' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'judul_buku' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255, // Lebih aman untuk judul panjang
            ),
            'penulis' => array(
                'type'       => 'VARCHAR',
                'constraint' => 100
            ),
            'penerbit' => array(
                'type' => 'VARCHAR',
                'constraint'=> 100
            ),
            'deskripsi' => array(
                'type' => 'TEXT', // Bisa menampung sinopsis panjang
                'null' => TRUE
            ),
            'harga' => array(
                'type'       => 'DECIMAL',
                'constraint' => '15,2', // Mampu menampung hingga triliunan rupiah dengan presisi sen
                'default'    => 0.00
            ),
            'halaman' => array(
                'type' => 'int',
                'constraint' => 10
            ),
            'rating' => array(
                'type'       => 'TINYINT',
                'constraint' => 1,        // Cukup 1 digit
                'unsigned'   => TRUE,     // Tidak mungkin rating negatif
                'default'    => 0,        // Atau 0 jika belum ada rating
                'null'       => FALSE
            ),
            'kategori' => array(
                'type'       => 'ENUM',
                'constraint' => array('bisnis&ekonomi', 'fiksi','edukasi','sejarah'), // Nilai yang diizinkan
                'null'       => FALSE
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('Buku');
    }

    public function down()
    {
        $this->load->dbforge();
        $this->dbforge->drop_table('Buku');
    }
}
