<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model {

    public function insert_user($data) {
        return $this->db->table('yjp_users')->insert($data);
    }

    public function get_all_users() {
        return $this->db->table('yjp_users')->get_all();
    }

    public function get_user_by_id($id) {
        return $this->db->table('yjp_users')->where('id', $id)->get();
    }

    public function update_user($id, $data) {
        return $this->db->table('yjp_users')->where('id', $id)->update($data);
    }

    public function delete_user($id) {
        return $this->db->table('yjp_users')->where('id', $id)->delete();
    }
}
?>