<?php
class User extends CI_Model {
    public function getAll() {
        return $this->db->get('users')->result();
    }
    public function get_by_email($email)
    {
        return $this->db->get_where('users',['email' => $email])->row();
    }
     public function GetPaginationUser($limit, $start)
    {
        return $this->db->get('users', $limit, $start)->result();
    }
    public function count_all_users()
    {
        return $this->db->count_all('users');
    }
}