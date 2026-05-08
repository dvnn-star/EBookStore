<?php
class User extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('users')->result();
    }
    public function get_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }
    public function GetPaginationUser($limit, $start)
    {
        return $this->db->get('users', $limit, $start)->result();
    }
    public function count_all_users()
    {
        return $this->db->count_all('users');
    }
    public function getById($slug)
    {
        return $this->db->get_where('users', ['id' => $slug])->row();
    }
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
    public function Delete($id)
    {
        $this->db->delete('users', ['id' => $id]);
    }
    public function insert($data)
    {
        $this->db->insert('users', $data);
    }
    public function CheckEmailInDatabase($email)
    {
        $user = $this->db
            ->select('id')
            ->where('email', $email)
            ->limit(1)
            ->get('users')
            ->row();
    return $user;
    }
}
