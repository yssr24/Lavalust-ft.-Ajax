<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->model('user_model');
    }

    public function add_user() {
        $data = array(
            'yjp_first_name' => $this->io->post('first_name'),
            'yjp_last_name' => $this->io->post('last_name'),
            'yjp_email' => $this->io->post('email'),
            'yjp_gender' => $this->io->post('gender'),
            'yjp_address' => $this->io->post('address')
        );

        if ($this->user_model->insert_user($data)) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function get_users() {
        $users = $this->user_model->get_all_users();
        echo json_encode($users);
    }

    public function edit_user() {
        $id = $this->io->get('id');
        $user = $this->user_model->get_user_by_id($id);
        echo json_encode($user);
    }

    public function update_user() {
        $id = $this->io->post('user_id');
        $data = array(
            'yjp_first_name' => $this->io->post('first_name'),
            'yjp_last_name' => $this->io->post('last_name'),
            'yjp_email' => $this->io->post('email'),
            'yjp_gender' => $this->io->post('gender'),
            'yjp_address' => $this->io->post('address')
        );

        if ($this->user_model->update_user($id, $data)) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function delete_user() {
        $id = $this->io->post('id');
        if ($this->user_model->delete_user($id)) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
}
?>