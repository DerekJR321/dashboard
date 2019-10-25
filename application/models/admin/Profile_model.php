<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Profile_model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
    }

    public function get_user_id($id) {
        $this->db->from('user');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($data) {
        $where = array('id' => $this->input->post('user_id'));
        $this->db->update('users', $data, $where);
        return $this->db->affected_rows();
    }
}
