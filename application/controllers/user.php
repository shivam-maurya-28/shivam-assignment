<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        // echo $this->db->count_all('users');
        $this->load->view('user_view');
    }
    public function saveUser()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('gender', 'Gender', 'required|in_list[Male,Female]');
        $this->form_validation->set_rules('state', 'State', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'failed',
                'message' => validation_errors()
            ]);
            return;
        }
        $email = strtolower($this->input->post('email', true));
        $this->db->where('email', $email);
        $this->db->where('deleted_at IS NULL', NULL, FALSE);
        if (!empty($id)) {
            $this->db->where('id !=', $id);
        }
        $existingEmail = $this->db->get('users')->num_rows();
        if ($existingEmail > 0) {
            echo json_encode([
                'status' => 'failed',
                'message' => 'Email already exists'
            ]);
            return;
        }
        

        $data = [
            'name' => $this->input->post('name', TRUE),
            'email' => $email,
            'mobile' => $this->input->post('mobile', TRUE),
            'gender' => $this->input->post('gender', TRUE),
            'state' => $this->input->post('state', TRUE)
        ];
        if (!empty($id)) {
            $result = $this->User_model->updateUser($id, $data);
            if ($result) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'User Updated Successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'failed',
                    'message' => 'Update Failed'
                ]);
            }
            return;
        }
        $insert = $this->User_model->insertUser($data);
        if ($insert) {
            echo json_encode([
                'status' => 'success',
                'message' => 'User added successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'failed',
                'message' => 'Insert Failed'
            ]);
        }
    }
    public function getUsers()
    {
        $users = $this->User_model->get_users();
        echo json_encode([
            'status' => true,
            'data' => $users
        ]);
    }
    public function getUser()
    {
        $id = $this->input->post('id');
        $user = $this->User_model->getSingleUser($id);
        echo json_encode($user);
    }
    public function deleteUser()
    {
        $id = $this->input->post('id');
        $delete = $this->db->where('id', $id)->update('users', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        if ($delete) {
            echo json_encode([
                'status' => 'success',
                'message' => 'User deleted successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'failed',
                'message' => 'Delete Failed'
            ]);
        }
    }
}
