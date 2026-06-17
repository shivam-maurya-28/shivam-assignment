<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function index()
    {
        // echo $this->db->count_all('users');
        $this->load->view('user_view');
    }
    public function saveUser()
    {
        $id = $this->input->post('id');
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),
            'gender' => $this->input->post('gender'),
            'state' => $this->input->post('state')
        ];
        if (!empty($id)) {
            $result = $this->User_model->updateUser($id, $data);
            echo json_encode([
                'status' => 'success',
                'message' => 'User Updated Successfully'
            ]);
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
        $delete = $this->User_model->deleteRecorde($id);
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