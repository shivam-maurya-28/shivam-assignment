<?php

class User_model extends CI_Model
{
    public function insertUser($data)
    {
        return $this->db->insert('users', $data);
    }
    public function updateUser($id, $data)
    {
        return $this->db->where('id', $id)->update('users', $data);
    }
    public function get_users()
    {
        return $this->db->where('deleted_at',NULL)->order_by('id', 'DESC')->get('users')->result_array();
    }
    public function getSingleUser($id)
    {
        return $this->db->where('id', $id)->get('users')->row_array();
    }
    public function deleteRecorde($id)
    {
        return $this->db->where('id', $id)->delete('users');
    }
}