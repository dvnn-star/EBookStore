<?php
class Buku extends CI_Model {
    public function getALL() {
        return $this->db->get('Buku')->result();
    }
}